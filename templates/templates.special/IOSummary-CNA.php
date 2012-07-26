<?php

#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All VMs Connections"; 
$this->MACRO['COMMENT'] = " ";


$hosts = array('BWDEV','BWPRD');
$ds_name = array();
$opt     = array();
$def     = array();

$i = 0;
foreach($hosts as $key=>$host){

$services = $this->tplGetServices("^$host$","check_win_io");

$ds_name[$i] = "Connections"; 
$opt[$i]     = "--vertical-label \"IO Utilization\" -l0 --title \" \" ";
$def[$i]     = "";

foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $def[$i]    .= rrd::def("b$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[$i]    .= rrd::line2("b$key", rrd::color($key%20+2), $a['MACRO']['HOSTNAME']."-".ereg_replace(".*_","",$a['MACRO']['SERVICEDESC'])."-busy");
    $def[$i]    .= rrd::gprint("b$key", array("LAST", "AVERAGE", "MAX"), "%.2lf");
}
$def[$i]    .= rrd::comment("\\r");
$def[$i]    .= rrd::comment("(STACKED GRAPH, rigid from 0-100)\\r");

$i = $i + 1;
}

?>
