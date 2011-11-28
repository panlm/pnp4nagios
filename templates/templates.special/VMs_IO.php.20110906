<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All ISVs DISK IO Reports"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("","check_snmp_iostat");

#
# The Name of this Datasource (ds)

$i = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $ds_name[$i] = $a['MACRO']['HOSTNAME'];
    $opt[$i]     = "--vertical-label \"\" -l0 --title \" \" ";
    $def[$i]     = "";
    #
    # get the data for a given Host/Service
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[$i]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
    $def[$i]    .= rrd::line2("a$key", "#CCCC33", "tps");
    $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[$i]    .= rrd::def("b$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "MAX");
    $def[$i]    .= rrd::line2("b$key", "#FF0000", "readKB");
    $def[$i]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[$i]    .= rrd::def("d$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "MAX");
    $def[$i]    .= rrd::line2("d$key", "#336666", "writeKB");
    $def[$i]    .= rrd::gprint("d$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $i = $i + 1;
}


?>
