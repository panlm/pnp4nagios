<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "ISCSI Ports Utilization for All ESX Servers"; 
$this->MACRO['COMMENT'] = " ";

# san-sw1
# 0/0 ctl0-a
# 0/1 ctl1-a
# 0/2 svr3-port1
# 0/3 svr1-port1
# 0/4 svr2-port1
# 0/5 svr4-port1
# san-sw2
# 0/0 ctl0-b
# 0/1 ctl1-b
# 0/2 svr3-port2
# 0/3 svr1-port2
# 0/4 svr2-port2
# 0/5 svr4-port2

$i=1;
$services = $this->tplGetServices("san-sw[12]","check_snmp_port_0_[01]");

$opt[$i] = "--vertical-label \"(bps)\" -l0 --title \"Throughput \" --base=1000 ";
$def[$i] = "";
$def1[$i] = "";
$def2[$i] = "";
$j=0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $label = $a['MACRO']['HOSTNAME']."-".ereg_replace("check_snmp_port_","",$a['MACRO']['SERVICEDESC'])."-" ;

    $def1[$i] .= rrd::def("a$key", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def2[$i] .= rrd::def("b$key", $a['DS'][0]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def2[$i] .= rrd::cdef("c$key","b$key,-1,*");
    if ( $j == 0 ) {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out") ;
        $j = 1;
    } else {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In", "STACK") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out", "STACK") ;
    }
    $def1[$i] .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
    $def2[$i] .= rrd::gprint("b$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
}

$def[$i] = $def1[$i] . $def2[$i];

#

$i=2;
$services = $this->tplGetServices("san-sw[12]","check_snmp_port_0_[34]");

$opt[$i] = "--vertical-label \"(bps)\" -l0 --title \"Throughput \" --base=1000 ";
$def[$i] = "";
$def1[$i] = "";
$def2[$i] = "";
$j=0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $label = $a['MACRO']['HOSTNAME']."-".ereg_replace("check_snmp_port_","",$a['MACRO']['SERVICEDESC'])."-" ;

    $def1[$i] .= rrd::def("a$key", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def2[$i] .= rrd::def("b$key", $a['DS'][0]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def2[$i] .= rrd::cdef("c$key","b$key,-1,*");
    if ( $j == 0 ) {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out") ;
        $j = 1;
    } else {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In", "STACK") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out", "STACK") ;
    }
    $def1[$i] .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
    $def2[$i] .= rrd::gprint("b$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
}

$def[$i] = $def1[$i] . $def2[$i];

#

$i=3;
$services = $this->tplGetServices("san-sw[12]","check_snmp_port_0_[25]");

$opt[$i] = "--vertical-label \"(bps)\" -l0 --title \"Throughput \" --base=1000 ";
$def[$i] = "";
$def1[$i] = "";
$def2[$i] = "";
$j=0;
foreach($services as $key=>$val){
    $a = $this->tplGetData($val['host'],$val['service']);
    $label = $a['MACRO']['HOSTNAME']."-".ereg_replace("check_snmp_port_","",$a['MACRO']['SERVICEDESC'])."-" ;

    $def1[$i] .= rrd::def("a$key", $a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "AVERAGE");
    $def2[$i] .= rrd::def("b$key", $a['DS'][0]['RRDFILE'], $a['DS'][1]['DS'], "AVERAGE");
    $def2[$i] .= rrd::cdef("c$key","b$key,-1,*");
    if ( $j == 0 ) {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out") ;
        $j = 1;
    } else {
        $def1[$i] .= rrd::line1("a$key", "#CCCC33", $label."In", "STACK") ;
        $def2[$i] .= rrd::line1("c$key", "#33FFFF", $label."Out", "STACK") ;
    }
    $def1[$i] .= rrd::gprint("a$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
    $def2[$i] .= rrd::gprint("b$key", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
}

$def[$i] = $def1[$i] . $def2[$i];

?>
