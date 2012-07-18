<?php

#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All VMs Connections"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("cf[0-9]+","check_snmp_conn");

#
# The Name of this Datasource (ds)
$ds_name[0] = "Connections"; 
$opt[0]     = "--vertical-label \"Connections\" -l0 --title \" \" --units-exponent=0 --base=1000 ";
$def[0]     = "";

foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[0]    .= rrd::line1("a$key", rrd::color($key%20), $a['MACRO']['HOSTNAME']);
    $def[0]    .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%.2lf");
}

#$ds_name[1] = "Connections"; 
#$opt[1]     = "--vertical-label \"Connections\" -l0 --title \" \" --units-exponent=0 --base=1000 ";
#$def[1]     = "";

#foreach($services as $key=>$val){
#    $a = $this->tplGetData($val['host'],$val['service']);
#    $def[1]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
#    $def[1]    .= rrd::area("a$key", rrd::color($key%20), $a['MACRO']['HOSTNAME'], "STACK");
#    $def[1]    .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%.2lf");
#}

?>
