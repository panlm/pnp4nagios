<?php

$color_list = array(
    0 => "#ff6600", // Orange
    1 => "#007dd0", // Blue
    2 => "#ff77ee", // Purple
    3 => "#fed409", // Yellow
    4 => "#ee0a04", // Red
    5 => "#56a901", // Green
    6 => "#336633", // darker green
    7 => "#a4a4a4"  // Grey
);

$this->MACRO['TITLE'] = "All ISVs DISK IO Reports"; 
$this->MACRO['COMMENT'] = " ";

###
# linux io
###

$services = $this->tplGetServices("","check_snmp_iostat");
$j = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $h[$j] = $a['MACRO']['HOSTNAME'];
    $j = $j + 1;
}
$hosts = array_unique($h);

$i = 0;
foreach($hosts as $key=>$host){
    $services    = $this->tplGetServices($host,"check_snmp_iostat");
    $ds_name[$i] = $host;
    $opt[$i]     = "--vertical-label \"\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $def[$i]    .= rrd::def("a$key" ,$a['DS'][10]['RRDFILE'], $a['DS'][10]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("a$key", $color_list[$key]."32");
        $def[$i]    .= rrd::line1("a$key", $color_list[$key]."FF", ereg_replace(".*_","",$a['MACRO']['SERVICEDESC'])."-util%");
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
    $i = $i + 1;
}

###
# windows io
###

$services = $this->tplGetServices("","check_win_io");
$j = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $h[$j] = $a['MACRO']['HOSTNAME'];
    $j = $j + 1;
}
$hosts = array_unique($h);

$i = $i + 1;
foreach($hosts as $key=>$host){
    $services    = $this->tplGetServices($host,"check_win_io");
    $ds_name[$i] = $host;
    $opt[$i]     = "--vertical-label \"\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $def[$i]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
        $def[$i]    .= rrd::area("a$key", $color_list[$key]."32");
        $def[$i]    .= rrd::line1("a$key", $color_list[$key]."FF", ereg_replace(".*_","",$a['MACRO']['SERVICEDESC'])."-util%");
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
    $i = $i + 1;
}

?>
