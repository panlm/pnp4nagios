<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# Network Bandwidth
#
$opt[1] = "--vertical-label Throughput(bps) -l0  --title \"Network Throughput for $hostname\" ";

$def[1] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[3], "AVERAGE");

$def[1] .= rrd::line2("var1", "#CCCC33", "In") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", "#33FFFF", "Out") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

#
# Network Utilization
#
$opt[2] = "--vertical-label \"Percent(%)\" -l0  --title \"Network Utilization for $hostname\" ";

$def[2] = rrd::def("var1", $RRDFILE[1], $DS[2], "AVERAGE");
$def[2] .= rrd::def("var2", $RRDFILE[1], $DS[4], "AVERAGE");

$def[2] .= rrd::area("var1", "#336666", "InPct") ;
$def[2] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::area("var2", "#339966", "OutPct", "STACK") ;
$def[2] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment(" \\n");
$def[2] .= rrd::comment(" (STACKED GRAPH)\\r");

#
# Network Discards & Errors Rate
#
$opt[3] = "--vertical-label Percent(%) -l0  --title \"Network Discards & Errors Rate for $hostname\" ";

$def[3] = rrd::def("var1", $RRDFILE[1], $DS[5], "AVERAGE");
$def[3] .= rrd::def("var2", $RRDFILE[1], $DS[6], "AVERAGE");
$def[3] .= rrd::def("var3", $RRDFILE[1], $DS[7], "AVERAGE");
$def[3] .= rrd::def("var4", $RRDFILE[1], $DS[8], "AVERAGE");

$def[3] .= rrd::line2("var1", "#33FF99", "InDiscardRate") ;
$def[3] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var2", "#99FF66", "OutDiscardRate") ;
$def[3] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var1", "#003300", "InErrorRate") ;
$def[3] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line2("var2", "#336666", "OutErrorRate") ;
$def[3] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
