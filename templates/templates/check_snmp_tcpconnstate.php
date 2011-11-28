<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "TCP Connection State (Openning)";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"\" -l0  --title \"$ds_name[0] for $hostname\" ";

$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
$def[0] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[0] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
$def[0] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");

$def[0] .= rrd::line2("var2", rrd::color(2), "listen") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var3", rrd::color(3), "synSent") ;
$def[0] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var4", rrd::color(4), "synReceived") ;
$def[0] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var5", rrd::color(5), "established") ;
$def[0] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment(" (NO STACKED GRAPH)\\r");

#
$ds_name[1] = "TCP Connection State (Closing)";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"\" -l0  --title \"$ds_name[1] for $hostname\" ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var6", $RRDFILE[1], $DS[6], "AVERAGE");
$def[1] .= rrd::def("var7", $RRDFILE[1], $DS[7], "AVERAGE");
$def[1] .= rrd::def("var8", $RRDFILE[1], $DS[8], "AVERAGE");
$def[1] .= rrd::def("var9", $RRDFILE[1], $DS[9], "AVERAGE");
$def[1] .= rrd::def("var10", $RRDFILE[1], $DS[10], "AVERAGE");
$def[1] .= rrd::def("var11", $RRDFILE[1], $DS[11], "AVERAGE");
$def[1] .= rrd::cdef("cvar11", "var11,1000,/");
$def[1] .= rrd::def("var12", $RRDFILE[1], $DS[12], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(1), "closed") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var6", rrd::color(6), "finWait1") ;
$def[1] .= rrd::gprint("var6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var7", rrd::color(7), "finWait2") ;
$def[1] .= rrd::gprint("var7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var8", rrd::color(8), "closeWait") ;
$def[1] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var9", rrd::color(9), "lastAck") ;
$def[1] .= rrd::gprint("var9", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var10", rrd::color(10), "closing") ;
$def[1] .= rrd::gprint("var10", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("cvar11", rrd::color(11), "timeWait/1000") ;
$def[1] .= rrd::gprint("cvar11", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var12", rrd::color(12), "deleteTCB") ;
$def[1] .= rrd::gprint("var12", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" (NO STACKED GRAPH)\\r");

?>
