<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "ISCSI Ports Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

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

$hosts = array('esx01', 'esx02', 'esx03', 'esx04', 'esx05', 'PS6000');

$ds_name = array();
$opt     = array();
$def     = array();
$def1    = array();
$def2    = array();
$def3    = array();
$def4    = array();
$str     = "";

$i = 0;
foreach($hosts as $key=>$host){
    #
    # get the data for a given Host/Service
    #$services = $this->tplGetServices($host,"check_snmp_net_detail_esx");
    switch ($host) {
    case 'esx01':
        $services = $this->tplGetServices('esx01','check_snmp_port_vmnic[02]');
        break;
    case 'esx02':
        $services = $this->tplGetServices('esx02','check_snmp_port_vmnic[02]');
        break;
    case 'esx03':
        $services = $this->tplGetServices('esx03','check_snmp_port_vmnic[02]');
        break;
    case 'esx04':
        $services = $this->tplGetServices('esx04','check_snmp_port_vmnic[4567]');
        break;
    case 'esx05':
        $services = $this->tplGetServices('esx05','check_snmp_port_vmnic[456]');
        break;
    case 'PS6000':
        $services = $this->tplGetServices('PS6000','check_snmp_port_p[1234]');
        break;
    default:
        ;
    }
    $ds_name[$i]  = $host . " ISCSI Ports";
    $opt[$i]      = "--vertical-label \"bps\" --title \" \" --units-exponent=6 -u 100000000 -l \"-100000000\" -w 800 -h 200 ";
    $def[$i]      = "";
    $def1[$i]     = "";
    $def2[$i]     = "";
    $def3[$i]     = "";
    $def4[$i]     = "";
    $j = 0;
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $str          = rrd::def("a$i$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def1[$i]    .= $str;
        $def3[$i]    .= $str;
        if ($j == 0) {
            $def1[$i]    .= rrd::area("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN');
        } else {
            $def1[$i]    .= rrd::area("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN', "STACK");
        }
        if ($i == 0 && $j == 0) {
            $def3[$i]    .= rrd::area("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN');
        } else {
            $def3[$i]    .= rrd::area("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN', "STACK");
        }
        $str          = rrd::gprint("a$i$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def1[$i]    .= $str;
        $def3[$i]    .= $str;

        $str          = rrd::def("b$i$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
        $str         .= rrd::cdef("c$i$key" ,"0,b$i$key,-");
        $def2[$i]    .= $str;
        $def4[$i]    .= $str;
        if ($j == 0) {
            $def2[$i]    .= rrd::area("c$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT');
        } else {
            $def2[$i]    .= rrd::area("c$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT', "STACK");
        }
        if ($i == 0 && $j == 0) {
            $def4[$i]    .= rrd::area("c$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT');
        } else {
            $def4[$i]    .= rrd::area("c$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT', "STACK");
        }
        $str          = rrd::gprint("b$i$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def2[$i]    .= $str;
        $def4[$i]    .= $str;
        $j++;
    }
    if ($host == 'PS6000') {
        $def3[$i] = "";
        $def4[$i] = "";
    }
    $def[$i] .= $def1[$i] . $def2[$i];
    $i++;
}

$ds_name[$i]  = "All ESXs ISCSI Ports";
$opt[$i]      = "--vertical-label \"bps\" --title \" \" --units-exponent=6 -u 100000000 -l \"-100000000\" -w 800 -h 200 ";
$def[$i] = "";
foreach($def3 as $key=>$val){
    $def[$i] .= $val;
}
foreach($def4 as $key=>$val){
    $def[$i] .= $val;
}

?>
