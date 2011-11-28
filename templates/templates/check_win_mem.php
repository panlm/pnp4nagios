<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "Memory Usage";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"Bytes\" -l0  --title \"Memory Usage for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(2), "used") ;
$def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[1] = "Memory Utilization";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"%\" -l0  --title \"Memory Utilization for $hostname\" -l 0 -u 100 -r ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[2], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(3), "util") ;
$def[1] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
