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

$this->MACRO['TITLE'] = "CPU Utilization for ALL ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$myenvs = array("prod","mgmt");
$i = 0;

foreach($myenvs as $key=>$myenv){

    if ( $myenv == "prod" ){
        $services = $this->tplGetServices("esxi0[1-9]","check_esxi_cpu");
        $string = "Production";
    } else if ( $myenv == "mgmt" ) {
        $services = $this->tplGetServices("esxi1[1-9]","check_esxi_cpu");
        $string = "Management";
    }

    #
    # The Name of this Datasource (ds)
    $ds_name[$i] = $string . " ESX Server CPU"; 
    $opt[$i]     = "--vertical-label \"CPU Util (%)\" -l0 --title \"CPU Max Utilization for $string\" ";
    $def[$i]     = "";

    $ds_name[$i+1] = $string . " ESX Server CPU (STACKED GRAPH)"; 
    $opt[$i+1]     = "--vertical-label \"CPU Util (%)\" -l0 --title \"CPU Max Utilization for $string (STACKED GRAPH)\" ";
    $def[$i+1]     = "";

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
        $def[$i]      .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
        $def[$i]      .= rrd::area("a$key", $color_list[$j]."32");
        $def[$i]      .= rrd::line1("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME']);
        $def[$i]      .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

        $def[$i+1]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
        $def[$i+1]    .= rrd::area("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME'], "STACK");
        $def[$i+1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

        $j++;
    }
    $i = $i + 2;
}

?>

