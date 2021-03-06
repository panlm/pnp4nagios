<?php
#
#
#
$opt[1] = "--vertical-label \"\" -l0  --title \"Disk IO Queue for $hostname w/ WMI\" ";

$def[1] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::line2("var1", rrd::color(8), "queue") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

#
#
#
$opt[2] = "--vertical-label \"KB\" -l0  --title \"Disk IO Utilization for $hostname w/ WMI\" ";

$def[2] = rrd::def("var1", $RRDFILE[1], $DS[2], "AVERAGE");
$def[2] .= rrd::def("var2", $RRDFILE[1], $DS[3], "AVERAGE");

$def[2] .= rrd::line2("var1", rrd::color(10), "read") ;
$def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var2", rrd::color(7), "write") ;
$def[2] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment(" (NO STACKED GRAPH)\\r");
?>
