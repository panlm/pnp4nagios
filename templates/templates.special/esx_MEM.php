<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "Memory Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("esx0[1-7]","check_esx3_server_mem");

#
# The Name of this Datasource (ds)
$ds_name[0]  = "";
$def[0]      = "";
$opt[0]      = "";
$ds_name[0] .= "ESX Server MEM Free"; 
$opt[0]     .= "--vertical-label \"Size (MB)\" -l0 --title \"Memory Free for All ESX Servers\" -u 65526 --units-exponent=0 -h 200 ";
$opt[0]     .= "--right-axis 0.001526111772426212:0 --right-axis-label \"percent(%)\" ";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    if ( $a['MACRO']['HOSTNAME'] == "esx06" || $a['MACRO']['HOSTNAME'] == "esx07" ) {
        $def[0]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME']."(48GB)");
    } else {
        $def[0]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME']."(64GB)");
    }
    $def[0]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

#$def[0]     .= "HRULE:65526" . rrd::color(5) . ":memory_limit(64GB-100%) " ;
#$def[0]     .= "HRULE:49152" . rrd::color(5) . ":memory_limit(48GB-100%) " ;

#
# The Name of this Datasource (ds)
$ds_name[1] = "ESX Server MEM Ballon"; 
$opt[1]     = "--vertical-label \"Size (MB)\" -l0 --title \"Memory Ballon for All ESX Servers\" --units-exponent=0 -h 200";
$def[1]     = "";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[1]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[1]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME']);
    $def[1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

?>
