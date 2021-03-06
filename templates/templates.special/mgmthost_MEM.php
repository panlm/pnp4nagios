<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All ISVs Memory Average Utilization Reports"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("localhost|netflow|vcsvr|VirtCenter2|isv20hostrd1|isv20hostrd2|isv20host3|isv20host5|isv20host6","check_snmp_mem_detail");

#
# The Name of this Datasource (ds)

$i = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $ds_name[$i] = $a['MACRO']['HOSTNAME'];
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    #
    # get the data for a given Host/Service
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[$i]    .= rrd::def("a$key" ,$a['DS'][7]['RRDFILE'], $a['DS'][7]['DS'], "AVERAGE");
    $def[$i]    .= rrd::line2("a$key", "#CCCC33", "memutil");
    $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[$i]    .= rrd::def("b$key" ,$a['DS'][8]['RRDFILE'], $a['DS'][8]['DS'], "AVERAGE");
    $def[$i]    .= rrd::line2("b$key", "#33FFFF", "actutil");
    $def[$i]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[$i]    .= rrd::def("c$key" ,$a['DS'][9]['RRDFILE'], $a['DS'][9]['DS'], "AVERAGE");
    $def[$i]    .= rrd::line2("c$key", "#336666", "swaputil");
    $def[$i]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $i = $i + 1;
}

$services = $this->tplGetServices("localhost|netflow|vcsvr|VirtCenter2|isv20hostrd1|isv20hostrd2|isv20host3|isv20host5|isv20host6","check_snmp_mem_w");

#
# The Name of this Datasource (ds)

$i = $i + 1;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $ds_name[$i] = $a['MACRO']['HOSTNAME'];
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    #
    # get the data for a given Host/Service
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[$i]    .= rrd::def("b$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
    $def[$i]    .= rrd::area("b$key", "#CCCC33", "memutil");
    $def[$i]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $i = $i + 1;
}

?>
