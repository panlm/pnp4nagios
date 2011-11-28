<?php
#
#
#
$this->MACRO['TITLE']   = "All ISVs File Systems"; 
$this->MACRO['COMMENT'] = "";
#
# Define the Service we want to graph
#$service = 'check_snmp_dsk';
#
# Define a List of Host
$hosts = array('groundwork', 'netflow', 'vcsvr', 'VirtCenter2', 'isv20hostrd1', 'isv20hostrd2', 'isv20host3', 'isv20host5', 'isv20host6');
#
# The Datasource Name for Graph 1 ( index 0 )
$ds_name = array();
$opt     = array();
$def     = array();
#
# Iterate through the list of hosts
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
        $def[$i]    .= rrd::line2("a$key", rrd::color($key), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']));
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
#    $def[$i]    .= "HRULE:60".rrd::color(10).":60-warn ";
#    $def[$i]    .= "HRULE:90".rrd::color(13).":90-crit ";
    $i++;
}
?>
