#ifndef _ALTERA_HPS_0_H_
#define _ALTERA_HPS_0_H_

/*
 * This file was automatically generated by the swinfo2header utility.
 * 
 * Created from SOPC Builder system 'DE1_SoC_QSYS' in
 * file 'soc_system.swinfo'.
 */

/*
 * This file contains macros for module 'hps_0' and devices
 * connected to the following masters:
 *   h2f_axi_master
 *   h2f_lw_axi_master
 * 
 * Do not include this header file and another header file created for a
 * different module or master group at the same time.
 * Doing so may result in duplicate macro names.
 * Instead, use the system header file which has macros with unique names.
 */

/*
 * Macros for device 'alt_vip_vfr_0', class 'alt_vip_vfr'
 * The macros are prefixed with 'ALT_VIP_VFR_0_'.
 * The prefix is the slave descriptor.
 */
#define ALT_VIP_VFR_0_COMPONENT_TYPE alt_vip_vfr
#define ALT_VIP_VFR_0_COMPONENT_NAME alt_vip_vfr_0
#define ALT_VIP_VFR_0_BASE 0x100
#define ALT_VIP_VFR_0_SPAN 512
#define ALT_VIP_VFR_0_END 0x2ff

/*
 * Macros for device 'ledr', class 'altera_avalon_pio'
 * The macros are prefixed with 'LEDR_'.
 * The prefix is the slave descriptor.
 */
#define LEDR_COMPONENT_TYPE altera_avalon_pio
#define LEDR_COMPONENT_NAME ledr
#define LEDR_BASE 0x10000
#define LEDR_SPAN 64
#define LEDR_END 0x1003f
#define LEDR_BIT_CLEARING_EDGE_REGISTER 0
#define LEDR_BIT_MODIFYING_OUTPUT_REGISTER 0
#define LEDR_CAPTURE 0
#define LEDR_DATA_WIDTH 10
#define LEDR_DO_TEST_BENCH_WIRING 0
#define LEDR_DRIVEN_SIM_VALUE 0
#define LEDR_EDGE_TYPE NONE
#define LEDR_FREQ 10000000
#define LEDR_HAS_IN 0
#define LEDR_HAS_OUT 1
#define LEDR_HAS_TRI 0
#define LEDR_IRQ_TYPE NONE
#define LEDR_RESET_VALUE 0

/*
 * Macros for device 'key', class 'altera_avalon_pio'
 * The macros are prefixed with 'KEY_'.
 * The prefix is the slave descriptor.
 */
#define KEY_COMPONENT_TYPE altera_avalon_pio
#define KEY_COMPONENT_NAME key
#define KEY_BASE 0x10010
#define KEY_SPAN 64
#define KEY_END 0x1004f
#define KEY_BIT_CLEARING_EDGE_REGISTER 0
#define KEY_BIT_MODIFYING_OUTPUT_REGISTER 0
#define KEY_CAPTURE 1
#define KEY_DATA_WIDTH 4
#define KEY_DO_TEST_BENCH_WIRING 0
#define KEY_DRIVEN_SIM_VALUE 0
#define KEY_EDGE_TYPE ANY
#define KEY_FREQ 10000000
#define KEY_HAS_IN 1
#define KEY_HAS_OUT 0
#define KEY_HAS_TRI 0
#define KEY_IRQ_TYPE EDGE
#define KEY_RESET_VALUE 0

/*
 * Macros for device 'sw', class 'altera_avalon_pio'
 * The macros are prefixed with 'SW_'.
 * The prefix is the slave descriptor.
 */
#define SW_COMPONENT_TYPE altera_avalon_pio
#define SW_COMPONENT_NAME sw
#define SW_BASE 0x10040
#define SW_SPAN 64
#define SW_END 0x1007f
#define SW_BIT_CLEARING_EDGE_REGISTER 0
#define SW_BIT_MODIFYING_OUTPUT_REGISTER 0
#define SW_CAPTURE 1
#define SW_DATA_WIDTH 10
#define SW_DO_TEST_BENCH_WIRING 0
#define SW_DRIVEN_SIM_VALUE 0
#define SW_EDGE_TYPE ANY
#define SW_FREQ 10000000
#define SW_HAS_IN 1
#define SW_HAS_OUT 0
#define SW_HAS_TRI 0
#define SW_IRQ_TYPE EDGE
#define SW_RESET_VALUE 0

/*
 * Macros for device 'seg7', class 'SEG7_IF'
 * The macros are prefixed with 'SEG7_'.
 * The prefix is the slave descriptor.
 */
#define SEG7_COMPONENT_TYPE SEG7_IF
#define SEG7_COMPONENT_NAME seg7
#define SEG7_BASE 0x10060
#define SEG7_SPAN 128
#define SEG7_END 0x100df

/*
 * Macros for device 'alt_vip_cti_0', class 'alt_vip_cti'
 * The macros are prefixed with 'ALT_VIP_CTI_0_'.
 * The prefix is the slave descriptor.
 */
#define ALT_VIP_CTI_0_COMPONENT_TYPE alt_vip_cti
#define ALT_VIP_CTI_0_COMPONENT_NAME alt_vip_cti_0
#define ALT_VIP_CTI_0_BASE 0x10080
#define ALT_VIP_CTI_0_SPAN 256
#define ALT_VIP_CTI_0_END 0x1017f

/*
 * Macros for device 'alt_vip_mix_0', class 'alt_vip_mix'
 * The macros are prefixed with 'ALT_VIP_MIX_0_'.
 * The prefix is the slave descriptor.
 */
#define ALT_VIP_MIX_0_COMPONENT_TYPE alt_vip_mix
#define ALT_VIP_MIX_0_COMPONENT_NAME alt_vip_mix_0
#define ALT_VIP_MIX_0_BASE 0x10100
#define ALT_VIP_MIX_0_SPAN 1024
#define ALT_VIP_MIX_0_END 0x104ff

/*
 * Macros for device 'ir_rx', class 'TERASIC_IR_RX_FIFO'
 * The macros are prefixed with 'IR_RX_'.
 * The prefix is the slave descriptor.
 */
#define IR_RX_COMPONENT_TYPE TERASIC_IR_RX_FIFO
#define IR_RX_COMPONENT_NAME ir_rx
#define IR_RX_BASE 0x10200
#define IR_RX_SPAN 32
#define IR_RX_END 0x1021f


#endif /* _ALTERA_HPS_0_H_ */