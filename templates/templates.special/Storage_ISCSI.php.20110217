<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "ISCSI Ports Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

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
        $services = $this->tplGetServices('esx01','check_snmp_net_detail_esx_vmnic[0213]');
        break;
    case 'esx02':
        $services = $this->tplGetServices('esx02','check_snmp_net_detail_esx_vmnic[0213]');
        break;
    case 'esx03':
        $services = $this->tplGetServices('esx03','check_snmp_net_detail_esx_vmnic[0213]');
        break;
    case 'esx04':
        $services = $this->tplGetServices('esx04','check_snmp_net_detail_esx_vmnic[45670123]');
        break;
    case 'esx05':
        $services = $this->tplGetServices('esx05','check_snmp_net_detail_esx_vmnic[45601237]');
        break;
    case 'PS6000':
        $services = $this->tplGetServices('PS6000','check_snmp_net_detail_ps6000_p[1234]');
        break;
    default:
        #$services = $this->tplGetServices($host,"check_snmp_net_detail_esx");
        ;
    }
    $ds_name[$i]  = $host . " ISCSI Ports";
    $opt[$i]      = "--vertical-label \"bps\" -l0 --title \" \" --units-exponent=6 -u 10000000 ";
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
            $def1[$i]    .= rrd::line1("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN');
        } else {
            $def1[$i]    .= rrd::line1("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN', "STACK");
        }
        if ($i == 0 && $j == 0) {
            $def3[$i]    .= rrd::line1("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN');
        } else {
            $def3[$i]    .= rrd::line1("a$i$key", rrd::color(2), $a['MACRO']['SERVICEDESC'].'-'.'IN', "STACK");
        }
        $str          = rrd::gprint("a$i$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def1[$i]    .= $str;
        $def3[$i]    .= $str;

        $str          = rrd::def("b$i$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
        $def2[$i]    .= $str;
        $def4[$i]    .= $str;
        if ($j == 0) {
            $def2[$i]    .= rrd::line1("b$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT');
        } else {
            $def2[$i]    .= rrd::line1("b$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT', "STACK");
        }
        if ($i == 0 && $j == 0) {
            $def4[$i]    .= rrd::line1("b$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT');
        } else {
            $def4[$i]    .= rrd::line1("b$i$key", rrd::color(7), $a['MACRO']['SERVICEDESC'].'-'.'OUT', "STACK");
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
$opt[$i]      = "--vertical-label \"bps\" -l0 --title \" \" --units-exponent=6 -u 10000000 ";
$def[$i] = "";
foreach($def3 as $key=>$val){
    $def[$i] .= $val;
}
foreach($def4 as $key=>$val){
    $def[$i] .= $val;
}

?>
