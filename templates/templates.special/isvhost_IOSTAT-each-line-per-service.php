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
    $def[$i]    .= rrd::def("a$key" ,$a['DS'][10]['RRDFILE'], $a['DS'][10]['DS'], "AVERAGE");
    $def[$i]    .= rrd::line2("a$key", "#CCCC33", ereg_replace(".*_","",$a['MACRO']['SERVICEDESC'])."-util%");
    $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $i = $i + 1;
}


?>
