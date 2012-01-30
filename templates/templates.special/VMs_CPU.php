<?php
#
# Some Macros 
$this->MACRO['TITLE'] = "All ISVs CPU Maximum Utilization Reports"; 
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("ent|isv","check_snmp_cpu_");

$i = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $ds_name[$i] = $a['MACRO']['HOSTNAME'];
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" -u 100 -r ";
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
    }
    $i = $i + 1;
}

?>
