<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "SWAP Usage";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label Size(KB) -l0  --title \"SWAP Usage for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(1), "TotalSwap") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(2), "AvailSwap") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment(" (NO STACKED GRAPH)\\r");

#
$ds_name[1] = "Memory Usage";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label Size(KB) -l0  --title \"Memory Usage for $hostname\" ";

$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
$def[1] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");
$def[1] .= rrd::def("var6", $RRDFILE[1], $DS[6], "AVERAGE");
$def[1] .= rrd::def("var7", $RRDFILE[1], $DS[7], "AVERAGE");

$def[1] .= rrd::line2("var3", rrd::color(3), "TotalMem") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var4", rrd::color(4), "AvailMem") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var5", rrd::color(5), "Shared") ;
$def[1] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var6", rrd::color(6), "Buffer") ;
$def[1] .= rrd::gprint("var6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var7", rrd::color(7), "Cached") ;
$def[1] .= rrd::gprint("var7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" (NO STACKED GRAPH)\\r");

#
$ds_name[2] = "Memory Utilization";
$opt[2]     = "";
$def[2]     = "";

$opt[2] .= "--vertical-label Percent(%) -l0  --title \"Memory Utilization for $hostname\" ";

$def[2] .= rrd::def("var1", $RRDFILE[1], $DS[8], "AVERAGE");
$def[2] .= rrd::def("var2", $RRDFILE[1], $DS[9], "AVERAGE");
$def[2] .= rrd::def("var3", $RRDFILE[1], $DS[10], "AVERAGE");

$def[2] .= rrd::line2("var1", rrd::color(9), "memutil") ;
$def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var2", rrd::color(10), "actutil") ;
$def[2] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var3", rrd::color(11), "swaputil") ;
$def[2] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment(" (NO STACKED GRAPH)\\r");

?>
