<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All ISVs Bandwidth Utilization"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("YJDDC-FW","check_snmp_port_ent");

#
# The Name of this Datasource (ds)
$ds_name[0] = "In"; 
$opt[0]     = "--vertical-label \" \" -l0 --title \"Top Bandwidth Utilization (bps)\" -w 800 ";
$def[0]     = "";

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
    $def[0]    .= rrd::line1("a$key", rrd::color($key), $a['MACRO']['SERVICEDESC']);
    $def[0]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

#
# The Name of this Datasource (ds)
$ds_name[1] = "Out";
$opt[1]     = "--vertical-label \" \" -l0 --title \"Top Bandwidth Utilization (bps)\" -w 800 ";
$def[1]     = "";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[1]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "MAX");
    $def[1]    .= rrd::line1("a$key", rrd::color($key), $a['MACRO']['SERVICEDESC']);
    $def[1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

?>
