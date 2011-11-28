<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# Disk
#
$services = $this->tplGetServices($hostname,"check_snmp_dsk");

$ds_name[3] = "";
$opt[3]     = "";
$def[3]     = "";

if ( ! preg_match("/(check_snmp_dsk_root|check_snmp_dsk_c)/",$servicedesc) ) {
    return;
}

$ds_name[3] = $hostname . " File Systems";
$opt[3]     = "--vertical-label \"Util(%)\" -l0 --title \"$ds_name[3] \" -u 100 ";
$def[3]     = "";
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $def[3]    .= rrd::def("a$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
    #$def[3]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME'].'-'.$a['MACRO']['SERVICEDESC']);
    $def[3]    .= rrd::line2("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']));
    $def[3]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

$ds_name[4] = $hostname . " File Systems";
$opt[4]     = "--vertical-label \" \" -l0 --title \"$ds_name[3] \" -u 100 --units-exponent=0 ";
$def[4]     = "";
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $def[4]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[4]    .= rrd::def("b$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[4]    .= rrd::line2("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']).'-total');
    $def[4]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[4]    .= rrd::line2("b$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']).'-used');
    $def[4]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

?>
