<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# Network Bandwidth
#
$opt[1]  = "--vertical-label \" \" -l0  --title \"Max Network Throughput for $hostname\" ";
#$opt[1] .= "--units-exponent=0 ";
$opt[1] .= "--units-exponent=6 ";

$def[1]  = rrd::def("var1", $RRDFILE[1], $DS[1], "MAX");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[2], "MAX");

$def[1] .= rrd::line2("var1", "#CCCC33", "In(bps)") ;
$def[1] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", "#33FFFF", "Out(bps)") ;
$def[1] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" (NO STACKED GRAPH)\\r");

#
# Network Discards & Errors Rate
#
$opt[3] = "--vertical-label Percent(%) -l0  --title \"Max Network Discards & Errors Rate for $hostname\" ";

$def[3] = rrd::def("var5", $RRDFILE[1], $DS[3], "MAX");
$def[3] .= rrd::def("var6", $RRDFILE[1], $DS[4], "MAX");
$def[3] .= rrd::def("var7", $RRDFILE[1], $DS[5], "MAX");
$def[3] .= rrd::def("var8", $RRDFILE[1], $DS[6], "MAX");

$def[3] .= rrd::line2("var5", "#33FF99", "InDiscardRate") ;
$def[3] .= rrd::gprint("var5", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var6", "#99FF66", "OutDiscardRate") ;
$def[3] .= rrd::gprint("var6", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var7", "#003300", "InErrorRate") ;
$def[3] .= rrd::gprint("var7", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var8", "#336666", "OutErrorRate") ;
$def[3] .= rrd::gprint("var8", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::comment(" (NO STACKED GRAPH)\\r");

?>
