#include <devbox_ioctl_driver.h>

#include <stdio.h>

int main()
{
 int x=open_devbox_io();
 if(x<0)
        printf("FAIL!\n");
 else
{
	
	printf("SUCCESS %x\n",x);
	int q=devbox_get_sw(x);
	printf("Switches= %x\n",q);
	devbox_set_led(x,q);
	devbox_set_7seg(x,0,123);
	devbox_set_7seg(x,1,21);
	devbox_set_7seg(x,2,123);
	devbox_set_7seg(x,3,123);
	devbox_7seg_write(x, 0xaf7701);
	close_devbox_io(x);
	
} 
 return 0;
}