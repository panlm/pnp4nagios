<?php
#
# This is a very basic static Template
#
#
# Some Macros 
$this->MACRO['TITLE'] = "PING DELAY STATISTICS";
$this->MACRO['COMMENT'] = " ";

$services = $this->tplGetServices("(10080|bjonline1|bjonline2|cqonline|gznet|hljradio|jschina|newssc|sdinfo|shangdu|shonline|tjonline|yinsha|tbapi)","icmp_ping_alive");

#
# The Name of this Datasource (ds)
$ds_name[0] = "PING DELAY STATISTICS"; 
$opt[0]     = "--vertical-label \"(ms)\" -l0 --title \"PING DELAY STATISTICS\" ";
$def[0]     = "";
$ds_name[1] = "LOST PACKET PERCENT"; 
$opt[1]     = "--vertical-label \"(%)\" -l0 --title \"LOST PACKET PERCENT\" ";
$def[1]     = "";

foreach($services as $key=>$val){
    #
    # get the data for a given Host/Service
    $a = $this->tplGetData($val['host'],$val['service']);
    #
    # Throw an exception to debug the content of $a
    # Just to get Infos about the Array Structure
    #
    #throw new Kohana_exception(print_r($a,TRUE));
    $def[0]    .= rrd::def("a$key" ,$a['DS'][0]['RRDFILE'], $a['DS'][0]['DS'], "MAX");
    $def[0]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME']);
    $def[0]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
    $def[1]    .= rrd::def("a$key" ,$a['DS'][1]['RRDFILE'], $a['DS'][1]['DS'], "MAX");
    $def[1]    .= rrd::line2("a$key", rrd::color($key), $a['MACRO']['HOSTNAME']);
    $def[1]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
}

?>

