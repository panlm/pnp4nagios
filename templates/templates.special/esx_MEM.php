<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "Memory Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$services  = $this->tplGetServices("esx0[1-7]","check_esx3_server_mem");
$pod1  = $this->tplGetServices("esx0[1-5]","check_esx3_server_mem");
$pod2  = $this->tplGetServices("esx0[6-7]","check_esx3_server_mem");

#
# The Name of this Datasource (ds)
$ds_name[0]  = "";
$def[0]      = "";
$opt[0]      = "";
$ds_name[0] .= "ESX Server MEM Free"; 
$opt[0]     .= "--vertical-label \"(byte)\" -l0 --title \"Memory Free for All ESX Servers\" ";
$num = 100 / ( 65526 * 1024 * 1024 ) ;
$opt[0]     .= "--base 1024 --right-axis $num:0 --right-axis-label \"(%)\" ";

foreach($pod1 as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[0]    .= rrd::cdef("c$key" ,"a$key,1024,*,1024,*");
    $def[0]    .= rrd::line2("c$key", rrd::color($key), $a['MACRO']['HOSTNAME']."(64GB)");
    $def[0]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

#$def[0]     .= "HRULE:65526" . rrd::color(5) . ":memory_limit(64GB-100%) " ;
#$def[0]     .= "HRULE:49152" . rrd::color(5) . ":memory_limit(48GB-100%) " ;


$ds_name[1]  = "";
$def[1]      = "";
$opt[1]      = "";
$ds_name[1] .= "ESX Server MEM Free"; 
$opt[1]     .= "--vertical-label \"(byte)\" -l0 --title \"Memory Free for All ESX Servers\" ";
$num = 100 / ( 49152 * 1024 * 1024 ) ;
$opt[1]     .= "--base 1024 --right-axis $num:0 --right-axis-label \"(%)\" ";
foreach($pod2 as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[1]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[1]    .= rrd::cdef("c$key" ,"a$key,1024,*,1024,*");
    $def[1]    .= rrd::line2("c$key", rrd::color($key), $a['MACRO']['HOSTNAME']."(48GB)");
    $def[1]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}




#
# The Name of this Datasource (ds)
$ds_name[2] = "ESX Server MEM Ballon"; 
$opt[2]     = "--base 1024 --vertical-label \"(byte)\" -l0 --title \"Memory Ballon for All ESX Servers\" ";
$def[2]     = "";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[2]    .= rrd::def("a$key", $a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[2]    .= rrd::cdef("c$key", "a$key,1024,*,1024,*");
    $def[2]    .= rrd::line2("c$key", rrd::color($key), $a['MACRO']['HOSTNAME']);
    $def[2]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

?>
