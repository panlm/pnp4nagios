<?php
$ds_name[3] = "";
$opt[3]     = "";
$def[3]     = "";

#preg_replace('/^F(\d+)$/', 'Probe $1', $label)

$ds_name[3] = " File Systems: " . preg_replace('/check_snmp_dsk_/', '', $NAGIOS_SERVICEDESC);
$opt[3]     = "--vertical-label \"Util(%)\" -l0 --title \"$ds_name[3] \" -u 100 ";
$def[3]     = "";
$def[3]    .= rrd::def("a$key" ,$RRDFILE[1], $DS[3], "AVERAGE");
$def[3]    .= rrd::line2("a$key", rrd::color($key+2), "util");
$def[3]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

$ds_name[4] = $ds_name[3];
$opt[4]     = "--vertical-label \" Size(GB) \" -l0 --title \"$ds_name[4] \" -u 100 --units-exponent=0 ";
$def[4]     = "";
$def[4]    .= rrd::def("a$key" ,$RRDFILE[1], $DS[1], "AVERAGE");
$def[4]    .= rrd::def("b$key" ,$RRDFILE[1], $DS[2], "AVERAGE");
$def[4]    .= rrd::cdef("ca$key", "a$key,1024,/");
$def[4]    .= rrd::cdef("cb$key", "b$key,1024,/");
$def[4]    .= rrd::line2("ca$key", rrd::color($key+2), 'Total');
$def[4]    .= rrd::gprint("ca$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
$def[4]    .= rrd::line1("cb$key", rrd::color($key+2), 'Used');
$def[4]    .= rrd::gprint("cb$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

?>
