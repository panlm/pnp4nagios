<?php

require(dirname(__FILE__).'/../templates/color.php');

$this->MACRO['TITLE'] = "Memory Utilization for ALL ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

$myenvs = array("prod", "test", "ccec", "vfdd");
$i = 0;

foreach($myenvs as $key=>$myenv){

    if ( $myenv == "prod" ){
        $services = $this->tplGetServices("esxi0[1-9]","check_esxi_mem");
        $string = "Production";
    } else if ( $myenv == "test" ) {
        $services = $this->tplGetServices("esxi1[1-9]","check_esxi_mem");
        $string = "Testing";
    } else if ( $myenv == "ccec" ) {
        $services = $this->tplGetServices("esxi2[1-9]","check_esxi_mem");
        $string = "CCEC";
    } else if ( $myenv == "vfdd" ) {
        $services = $this->tplGetServices("esxi3[1-9]","check_esxi_mem");
        $string = "VFDD Beta";
    }

    #
    # The Name of this Datasource (ds)
    $ds_name[$i] = $string . " ESX Server Memory"; 
    $opt[$i]     = "--vertical-label \"Memory Util (%)\" -l0 --title \"Memory Utilization for $string\" -u 100 ";
    $def[$i]     = "";

    $ds_name[$i+1] = $string . " ESX Server Memory (STACKED GRAPH)"; 
    $opt[$i+1]     = "--vertical-label \"Memory Util (%)\" -l0 --title \"Memory Utilization for $string (STACKED GRAPH)\" -u 200 ";
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
        $def[$i]      .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i]      .= rrd::area("a$key", $color_list[$j]."32");
        $def[$i]      .= rrd::line1("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME']);
        $def[$i]      .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

        $def[$i+1]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i+1]    .= rrd::area("a$key", $color_list[$j]."FF", $a['MACRO']['HOSTNAME'], "STACK");
        $def[$i+1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

        $j++;
    }
    $i = $i + 2;
}

?>
