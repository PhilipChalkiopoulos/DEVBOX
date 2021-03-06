<?php
	//TutoriML.php
	//Keith Lee 2015
	//Functions for including .tml data in a webpage
	spl_autoload_register(function($class){
		require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
	});	
	use \Michelf\Markdown;
	
	function unfile($tml)
	{
		$ret=str_replace('_', ' ', $tml);
		$ret=str_replace('.tml', '', $ret);
		return $ret;
	}
	
	
	function getTagValue($handle, $tag)
	{
		$tag='`'.$tag;
		$ret="";
		while(!feof($handle))
		{
			$line=fgets($handle);
			$test=explode(' ',$line);
			if($test[0]==$tag)
			{
				$test=array_slice($test,1);
				$ret=implode(' ', $test);
				break;
			}
		}
		$ret=trim($ret);
		return $ret;
	}
	
	
	
	function getTitle($dir, $tml)
	{
		$file=$dir.'/'.$tml;
		$handle=fopen($file, "r");
		$title=getTagValue($handle,'title');
		fclose($handle);
		return $title;
	}
	
	function getPages($dir, $tml)
	{
		$file=$dir.'/'.$tml;
		$n_pages=1;
		$handle=fopen($file, "r");
		$n_pages=getTagValue($handle, 'n_pages');
		fclose($handle);
		return $n_pages;
	}
	
	function tmlSeek($handle, $startTag, $endTag)
	{
		$mask=" \t\0\x0B";
		$len=strlen($startTag);
		$elen=strlen($endTag);
		do
		{
			$line=fgets($handle);
			$line=ltrim($line,$mask);
		}while(strncmp($line,$startTag,$len)!=0 && strncmp($line,'`'.$endTag,$elen+1) !=0 && !feof($handle));
		return array($handle, $line);
	}
	
	function getDesc($dir, $tml, $page)
	{
		$mask=" \t\0\x0B";
		$file=$dir.'/'.$tml;
		$handle=fopen($file, "r");
		$startTag='`start '.$page;
		$endTag='``';
		$etLen=strlen($endTag);
		$altEndTag='`end '.$page;
		$aetLen=strlen($altEndTag);
		list($handle,$line)=tmlSeek($handle, $startTag, $altEndTag);
		
		if(strncmp($line, $altEndTag, $aetLen)==0 || feof($handle))
			return "";
		
		$block="";
		$line=fgets($handle);
		$line=ltrim($line,$mask);
		
		while(strncmp($line,$endTag,$etLen)!=0 && strncmp($line,$altEndTag,$aetLen)!=0  && !feof($handle))
		{
	
			$block=$block.$line;
			
			$line=fgets($handle);
			$line=ltrim($line,$mask);
		}
		fclose($handle);
		
		$html= Markdown::defaultTransform($block);
		return $html;
	}
	
	function getCode($dir, $tml, $page)
	{
		$code=array();
		$file=$dir.'/'.$tml;
		$handle=fopen($file, "r");
		
		$startTag='`start '.$page;
		list($handle,$line)=tmlSeek($handle, $startTag, "\0");
		$startTag='`code';
		$endTag='end';
		$etLen=strlen($endTag);
		$findEnd='`with';
		$feLen=strlen($findEnd);
		$elemEnd="``";
		$eeLen=strlen($elemEnd);
		while(strncmp($line,'`'.$endTag,$etLen+1)!=0 && !feof($handle))
		{
			
			list($handle,$line)=tmlSeek($handle, $startTag, $endTag);
			$elemMode=str_replace("`","",$line);
			$elemVal="";
			$line=fgets($handle);
			if(!strncmp($elemMode,'codereplace',strlen('codereplace')))
			{
				$findVal="";
				while(strncmp($line,$findEnd,$feLen)!=0 && strncmp($line,'`'.$endTag,$etLen+1)!=0 && !feof($handle))
				{
					$findVal.=$line;
					$line=fgets($handle);
				}
				$findVal=substr($findVal,0,-1);
				$line=fgets($handle);
			}
			
			while(strncmp($line,$elemEnd,$eeLen)!=0 && strncmp($line,'`'.$endTag,$etLen+1)!=0 && !feof($handle))
			{
				$elemVal=$elemVal.$line;
				$line=fgets($handle);
			}
					
			if(isset($findVal))
			{
				$elemVal=substr($elemVal,0,-1);
				$code[]=array($elemMode,$elemVal,$findVal);
				unset($findVal);
			}
			else
				$code[]=array($elemMode,$elemVal,"\0");
		
			if(strncmp($line, '`'.$endTag,$etLen+1))
				break;
		}
		fclose($handle);
		return $code;
	}
	
	function setCode($oldCode, $newCodeArray)
	{
		if(isset($oldCode))
			$newCode=$oldCode;
		else $newCode='';
		foreach($newCodeArray as $elem)
		{
			
			if(!strncmp($elem[0],'codeappend',strlen('codeappend')))
			{
				$x=strripos($newCode,"}");
				$newCode=$x.$newCode;
				if($x!=FALSE)
				{
					if(strpos(substr($newCode,$x),'int main()')!=FALSE)
					{
						$newCode.=$elem[1];
					
					}
					else 
					{
						$newCode=trim($newCode,'}').$elem[1].'}';
						}
				}
				else
				{
					$newCode.=$elem[1];
					}
			}
			else if(!strncmp($elem[0],'codeprepend',strlen('codeprepend')))
			{
				
				$newCode=$elem[1].$newCode;
			}
			else if(!strncmp($elem[0],'codeset',strlen('codeset')))
			{
				
				$newCode=$elem[1];
			}
			else if(!strncmp($elem[0],'codereplace', strlen('codereplace')))
			{
				
				$newCode=str_replace($elem[2], $elem[1], $newCode);
			}
		}
		return $newCode;
		
	}
	function unsetCode($oldCode, $newCodeArray)
	{
		
		if(isset($oldCode))
			$newCode=$oldCode;
		else $newCode='';
		
		foreach($newCodeArray as $elem)
		{
			
			if(!strncmp($elem[0],'codeappend',strlen('codeappend')) || !strncmp($elem[0],'codeprepend',strlen('codeprepend')))
			{
			
				$newCode=str_replace(substr($elem[1],0,-1),'',$newCode);
			}
		
			else if(!strncmp($elem[0],'codeset',strlen('codeset')))
			{
				
			}
			else if(!strncmp($elem[0],'codereplace',strlen('codereplace')))
			{
				$newCode=str_replace($elem[1], $elem[2], $newCode);
			}
		}
		return $newCode;
		
	}
	function fsetCode($file, $newCodeArray)
	{
		$newCode=file_get_contents($file);
		foreach($newCodeArray as $elem)
		{
			
			if(!strncmp($elem[0],'codeappend',strlen('codeappend')))
			{
				$x=strripos($newCode,"}");
				if($x!=FALSE)
				{
					if(strpos(substr($newCode,$x),'int main()')!=FALSE)
					{
						$newCode.=$elem[1];
					}
					else 
					{
						$newCode=substr($newCode,0,$x).$elem[1].'}';
					}
				}
				else
				{
					$newCode.=$elem[1];
				}
			}
			else if(!strncmp($elem[0],'codeprepend',strlen('codeprepend')))
			{
				
				$newCode=$elem[1].$newCode;
			}
			else if(!strncmp($elem[0],'codeset',strlen('codeset')))
			{
				
				$newCode=$elem[1];
			}
			else if(!strncmp($elem[0],'codereplace', strlen('codereplace')))
			{
				
				$newCode=str_replace($elem[2], $elem[1], $newCode);
			}
		}
		file_put_contents($file, $newCode);
	}
	
?>
