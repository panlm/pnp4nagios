<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "Percent Idle/Busy Time";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"\" -l0  --title \"$ds_name[0] for $hostname\" -l 0 -u 100 --rigid ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::area("var2", rrd::color(3), "busy") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::area("var1", rrd::color(2), "idle", "STACK") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment("\\r");
$def[0] .= rrd::comment("(STACKED GRAPH, rigid from 0-100)\\r");

#
$ds_name[1] = "Percent Read/Write Time";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"\" -l0  --title \"$ds_name[1] for $hostname\" ";

$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[4], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[5], "AVERAGE");

$def[1] .= rrd::line1("var3", rrd::color(2), "read") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line1("var4", rrd::color(3), "write") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment("\\r");

#
$ds_name[2] = "read/write bytes per second";
$opt[2]     = "";
$def[2]     = "";

$opt[2] .= "--vertical-label \"\" -l0  --title \"$ds_name[2] for $hostname\" ";

$def[2] .= rrd::def("var5", $RRDFILE[1], $DS[6], "AVERAGE");
$def[2] .= rrd::def("var6", $RRDFILE[1], $DS[8], "AVERAGE");

$def[2] .= rrd::line1("var5", rrd::color(2), "rB/s") ;
$def[2] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line1("var6", rrd::color(3), "wB/s") ;
$def[2] .= rrd::gprint("var6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment("\\r");

#
$ds_name[3] = "read/write per second";
$opt[3]     = "";
$def[3]     = "";

$opt[3] .= "--vertical-label \"\" -l0  --title \"$ds_name[3] for $hostname\" ";

$def[3] .= rrd::def("var7", $RRDFILE[1], $DS[7], "AVERAGE");
$def[3] .= rrd::def("var8", $RRDFILE[1], $DS[9], "AVERAGE");

$def[3] .= rrd::line1("var7", rrd::color(2), "r/s") ;
$def[3] .= rrd::gprint("var7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::line1("var8", rrd::color(3), "w/s") ;
$def[3] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::comment("\\r");

#
$ds_name[4] = "current disk queue length";
$opt[4]     = "";
$def[4]     = "";

$opt[4] .= "--vertical-label \"\" -l0  --title \"$ds_name[4] for $hostname\" ";

$def[4] .= rrd::def("var8", $RRDFILE[1], $DS[10], "AVERAGE");

$def[4] .= rrd::line2("var8", rrd::color(4), "queue") ;
$def[4] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[4] .= rrd::comment("\\r");

#
$ds_name[5] = "average queue length";
$opt[5]     = "";
$def[5]     = "";

$opt[5] .= "--vertical-label \"\" -l0  --title \"$ds_name[5] for $hostname\" ";

$def[5] .= rrd::def("var8", $RRDFILE[1], $DS[12], "AVERAGE");
$def[5] .= rrd::def("var9", $RRDFILE[1], $DS[13], "AVERAGE");

$def[5] .= rrd::line2("var8", rrd::color(2), "read") ;
$def[5] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[5] .= rrd::line2("var9", rrd::color(3), "write") ;
$def[5] .= rrd::gprint("var9", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[5] .= rrd::comment("\\r");

?>
