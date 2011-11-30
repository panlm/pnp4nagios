<?php
# EMPTY GRAPH
if ( ! preg_match("/check_snmp_throughput_ct/",$servicedesc) ) {
    $ds_name[0] = "SEE GRAPH ABOVE"; 
    $opt[0]     = "--vertical-label \" \" -l0 --title \" SEE GRAPH ABOVE \" -h 10 ";
    $def[0]     = "";
    $def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0] .= rrd::cdef("cvar1", "var1,0,*");
    $def[0] .= rrd::line1("cvar1", rrd::color(2), "SEE GRAPH ABOVE") ;
    $def[0] .= rrd::gprint("cvar1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
    $def[0] .= rrd::comment(" SEE GRAPH ABOVE \\r");
    return;
}

# Some Macros 
$this->MACRO['TITLE'] = "Top 5 ISVs Connections"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("$hostname","check_snmp_throughput_c[tu]");

# The Name of this Datasource (ds)
$ds_name[0] = "Internet In"; 
$opt[0]     = "--vertical-label \"Connections\" -l0 --title \" \" ";
$def[0]     = "";
$ds_name[1] = "Internet Out"; 
$opt[1]     = "--vertical-label \"Connections\" -l0 --title \" \" ";
$def[1]     = "";
$ds_name[2] = "Internet Connections"; 
$opt[2]     = "--vertical-label \"Connections\" -l0 --title \" \" ";
$def[2]     = "";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def[0]    .= rrd::area("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']), "STACK");
    $def[0]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

    $def[1]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def[1]    .= rrd::area("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']), "STACK");
    $def[1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

    $def[2]    .= rrd::def("a$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
    $def[2]    .= rrd::area("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']), "STACK");
    $def[2]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

$def[0] .= rrd::comment(" (STACKED GRAPH)\\r");
$def[1] .= rrd::comment(" (STACKED GRAPH)\\r");
$def[2] .= rrd::comment(" (STACKED GRAPH)\\r");

?>
