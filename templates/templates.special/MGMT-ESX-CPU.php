<?php
#
# This is a very basic static Template
#
#

$color_list = array(
    1 => "#ff77ee", // Purple
    2 => "#fed409", // Yellow
    3 => "#007dd0", // Blue
    4 => "#ee0a04", // Red
    5 => "#56a901", // Green
    6 => "#ff6600", // Orange
    7 => "#336633", // darker green
    8 => "#a4a4a4"  // Grey
);

# Some Macros 
$this->MACRO['TITLE'] = "CPU Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("esxi1[1-9]","check_snmp_load");

#
# The Name of this Datasource (ds)
$ds_name[0] = "ESX Server CPU"; 
$opt[0]     = "--vertical-label \"CPU Util (%)\" -l0 --title \"CPU Max Utilization for All ESX Servers\" ";
$def[0]     = "";

$ds_name[1] = "ESX Server CPU (STACKED GRAPH)"; 
$opt[1]     = "--vertical-label \"CPU Util (%)\" -l0 --title \"CPU Max Utilization for All ESX Servers (STACKED GRAPH)\" ";
$def[1]     = "";

$j = 1;
foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
    $def[0]    .= rrd::area("a$key", $color_list[$j]."32");
    $def[0]    .= rrd::line1("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME']);
    $def[0]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

    $def[1]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
    $def[1]    .= rrd::area("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME'], "STACK");
    $def[1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $j++;
}

?>

