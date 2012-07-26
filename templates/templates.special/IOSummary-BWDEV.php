<?php

#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "All VMs Connections"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("BWDEV","check_win_io");

#
# The Name of this Datasource (ds)
$ds_name[0] = "Connections"; 
$opt[0]     = "--vertical-label \"IO Utilization\" -l0 --title \" \" ";
$def[0]     = "";

foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
#    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[0]    .= rrd::def("b$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[0]    .= rrd::line2("b$key", rrd::color($key%20), $a['MACRO']['HOSTNAME']."-".ereg_replace(".*_","",$a['MACRO']['SERVICEDESC'])."-busy");
    $def[0]    .= rrd::gprint("b$key", array("LAST", "AVERAGE", "MAX"), "%.2lf");

#$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
#$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

#$def[0] .= rrd::area("var2", rrd::color(3), "busy") ;
#$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
#$def[0] .= rrd::area("var1", rrd::color(2), "idle", "STACK") ;
#$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
}
$def[0]    .= rrd::comment("\\r");
$def[0]    .= rrd::comment("(STACKED GRAPH, rigid from 0-100)\\r");

?>
