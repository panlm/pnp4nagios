<?php
#
#
#
$this->MACRO['TITLE']   = "All ISVs File Systems"; 
$this->MACRO['COMMENT'] = "";

$services = $this->tplGetServices("ent|isv","check_snmp_dsk");
$i = 0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $h[$i] = $a['MACRO']['HOSTNAME'];
    $i = $i + 1;
}
$hosts = array_unique($h);

$ds_name = array();
$opt     = array();
$def     = array();

$i = 0;
foreach($hosts as $key=>$host){
    #
    # get the data for a given Host/Service
    $services = $this->tplGetServices($host,"check_snmp_dsk");
    $ds_name[$i] = $host . " File Systems"; 
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $def[$i]    .= rrd::def("a$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
        #$def[$i]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME'].'-'.$a['MACRO']['SERVICEDESC']);
        $def[$i]    .= rrd::line2("a$key", rrd::color($key+2), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']));
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
#    $def[$i]    .= "HRULE:60".rrd::color(10).":60-warn ";
#    $def[$i]    .= "HRULE:90".rrd::color(13).":90-crit ";
    $i++;
}

?>
