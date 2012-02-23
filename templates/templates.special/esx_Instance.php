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
    6 => "#a4a4a4", // Grey
    7 => "#336633", // darker green
    8 => "#ff6600"  // Orange
);

# Some Macros 
$this->MACRO['TITLE'] = "Instances On All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("esx0[3-7]","check_esx3_server_instance");

#
# The Name of this Datasource (ds)
$ds_name[0] = "Instance"; 
$opt[0]     = "--vertical-label \"Count\" -l0 --title \"Instances On All ESX Servers\" ";
$def[0]     = "";

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
    $def[0]    .= rrd::line2("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME'], "STACK");
    $def[0]    .= rrd::gprint("a$key", array("AVERAGE", "MAX", "LAST"), "%.2lf%s");
    $j++;
}

?>

