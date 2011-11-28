<?php

$this->MACRO['TITLE']   = "All ISVs Monthly Report";
$this->MACRO['COMMENT'] = "";


#$hosts = array( 'isv3host1', 'isv3host2',);
$hosts = $this->getHosts();
$new_hosts = array();
foreach ($hosts as $host){
    if(preg_match("/isv/", $host['name'])){
        $new_hosts[] = $host['name'];
    }
}

$ds_name = array();
$opt     = array();
$def     = array();

$i=0;
foreach($new_hosts as $host){
    # CPU
    $services = $this->tplGetServices($host,"check_snmp_cpu");
    $ds_name[$i] = "CPU Utilization for " . $host;
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        if(preg_match("/check_snmp_cpu_w/",$val['service'])) {
            # cpu for windows host
            $def[$i]    .= rrd::def("a$key", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
            $def[$i]    .= rrd::area("a$key", rrd::color(6), "cpu_util");
            $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        } else {
            # cpu for linux host
            $def[$i]    .= rrd::def("a$key", $a['DS'][3]['RRDFILE'], $a['DS'][3]['DS'], "AVERAGE");
            $def[$i]    .= rrd::cdef("c$key", "100,a$key,-");
            $def[$i]    .= rrd::area("c$key", rrd::color(6), "cpu_util");
            $def[$i]    .= rrd::gprint("c$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        }
    }
    $i++;

    # MEM
    $services = $this->tplGetServices($host,"check_snmp_mem");
    $ds_name[$i] = "Memory Utilization for " . $host;
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        if(preg_match("/check_snmp_mem_w/",$val['service'])) {
            # mem for windows host
            $def[$i]    .= rrd::def("a$key", $a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
            $def[$i]    .= rrd::line2("a$key", rrd::color(7), "mem_util");
            $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        } else {
            # mem for linux host
            $def[$i]    .= rrd::def("var1", $a['DS'][7]['RRDFILE'], $a['DS'][7]['DS'], "AVERAGE");
            $def[$i]    .= rrd::def("var2", $a['DS'][8]['RRDFILE'], $a['DS'][8]['DS'], "AVERAGE");
            $def[$i]    .= rrd::line2("var1", rrd::color(7), "mem_util");
            $def[$i]    .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
            $def[$i]    .= rrd::line2("var2", rrd::color(8), "actual_util");
            $def[$i]    .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        }
    }
    $i++;

    # DISK
    $services = $this->tplGetServices($host,"check_snmp_dsk");
    $ds_name[$i] = "Disk Utilization for " . $host;
    $opt[$i]     = "--vertical-label \"Util(%)\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $def[$i]    .= rrd::def("a$key" ,$a['DS'][2]['RRDFILE'], $a['DS'][2]['DS'], "AVERAGE");
        $def[$i]    .= rrd::line2("a$key", rrd::color($key), ereg_replace(".*_","",$a['MACRO']['SERVICEDESC']));
        $def[$i]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
    $i++;

    # NET
    $services = $this->tplGetServices($host,"check_snmp_port");
    $ds_name[$i] = "Net Usage for " . $host;
    $opt[$i]     = "--vertical-label \"(bps)\" -l0 --title \" \" -u 100 ";
    $def[$i]     = "";
    foreach($services as $key=>$val){
        $a = $this->tplGetData($val['host'],$val['service']);
        $def[$i]    .= rrd::def("var1" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
        $def[$i]    .= rrd::def("var2" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
        $def[$i]    .= rrd::line2("var1", rrd::color(10), "In");
        $def[$i]    .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
        $def[$i]    .= rrd::line2("var2", rrd::color(9), "Out");
        $def[$i]    .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    }
    $i++;

}

?>
