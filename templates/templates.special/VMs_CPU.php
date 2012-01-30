<?php

$color_list = array(
    1 => "#ff77ee", // Purple
    2 => "#fed409", // Yellow
    3 => "#007dd0", // Blue
    4 => "#ee0a04", // Red
    5 => "#56a901", // Green
    6 => "#ff6600", // Orange
    7 => "#a4a4a4", // Grey
    8 => "#336633"  // darker green
);

# Some Macros 
$this->MACRO['TITLE'] = "All ISVs CPU Maximum Utilization Reports"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("local|ent|isv","check_snmp_cpu_|check_snmp_processor");

$i = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $ds_name[$i] = $a['MACRO']['HOSTNAME'] . ":" . $a['MACRO']['SERVICEDESC'];
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" $ds_name[$i]: \" -u 100 -r ";
    $def[$i]     = "";
    if ( preg_match("/check_snmp_cpu_detail/",$val['service']) ) {
        $def[$i]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("a$key", "#CCCC33", "nice");
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def[$i]    .= rrd::def("b$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("b$key", "#FF0000", "system", "STACK");
        $def[$i]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def[$i]    .= rrd::def("c$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("c$key", "#99FF66", "user", "STACK");
        $def[$i]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def[$i]    .= rrd::def("d$key" ,$a['DS'][4]['RRDFILE'], $a['DS'][4]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("d$key", "#336666", "wait", "STACK");
        $def[$i]    .= rrd::gprint("d$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def[$i]    .= rrd::def("e$key" ,$a['DS'][3]['RRDFILE'], $a['DS'][3]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("e$key", "#33FFFF", "idle", "STACK");
        $def[$i]    .= rrd::gprint("e$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    } elseif ( preg_match("/check_snmp_cpu_w/",$val['service']) ) {
        $def[$i]    .= rrd::def("b$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("b$key", "#FF0000", "cpu");
        $def[$i]    .= rrd::gprint("b$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    } elseif ( preg_match("/check_snmp_processor$/",$val['service']) ) {
        #$ds_name[$i] = "Processor Load";
        #$def[$i] = "";
        #$opt[$i] = "--vertical-label \"%\" -l0  --title \"$ds_name[0] for $hostname\" ";
        $def[$i] .= rrd::def("var1", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i] .= rrd::line2("var1", rrd::color(2), "average") ;
        $def[$i] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    } else {
        $def[$i] .= rrd::def("var1", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i] .= rrd::cdef("cvar1", "var1,0,*");
        $def[$i] .= rrd::line1("cvar1", rrd::color(2), "This is a empty graph") ;
        $def[$i] .= rrd::gprint("cvar1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
        $def[$i] .= rrd::comment(" This is a empty graph \\r");
    }
    $i = $i + 1;
}

?>
