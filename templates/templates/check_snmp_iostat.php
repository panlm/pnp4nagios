<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# the following graph is always zero
#
# $ds_name[0] = "request merged";
# $opt[0]     = "";
# $def[0]     = "";
# 
# $opt[0] .= "--vertical-label \"\" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";
# 
# $def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
# $def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
# 
# $def[0] .= rrd::line2("var1", rrd::color(1), "rrqm/s") ;
# $def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
# $def[0] .= rrd::line2("var2", rrd::color(2), "wrqm/s") ;
# $def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
# $def[0] .= rrd::comment("\\r");
# $def[0] .= rrd::comment("The number of read/write requests merged per second that were queued to the\\l");
# $def[0] .= rrd::comment("device.\\l");

#
$ds_name[1] = "read/write requests";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"\" -l0  --title \"$ds_name[1] for $hostname\" --units-exponent=0 ";

$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");

$def[1] .= rrd::line2("var3", rrd::color(3), "r/s") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var4", rrd::color(4), "w/s") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment("\\r");
$def[1] .= rrd::comment("The number of read/write requests that were issued to the device per second.\\l");

#
$ds_name[2] = "read/write kilobytes";
$opt[2]     = "";
$def[2]     = "";

$opt[2] .= "--vertical-label \"\" -l0  --title \"$ds_name[2] for $hostname\" --units-exponent=0 ";

$def[2] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");
$def[2] .= rrd::def("var6", $RRDFILE[1], $DS[6], "AVERAGE");

$def[2] .= rrd::line2("var5", rrd::color(9), "rKB/s") ;
$def[2] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var6", rrd::color(10), "wKB/s") ;
$def[2] .= rrd::gprint("var6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment("\\r");
$def[2] .= rrd::comment("The number of kilobytes read/write from the device per second.\\l");

#
$ds_name[3] = "average request size";
$opt[3]     = "";
$def[3]     = "";

$opt[3] .= "--vertical-label \"\" -l0  --title \"$ds_name[3] for $hostname\" --units-exponent=0 ";

$def[3] .= rrd::def("var7", $RRDFILE[1], $DS[7], "AVERAGE");

$def[3] .= rrd::line2("var7", rrd::color(9), "avgrq-sz") ;
$def[3] .= rrd::gprint("var7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[3] .= rrd::comment("\\r");
$def[3] .= rrd::comment("The average size (in sectors) of the requests that were issued to the device.\\l");

#
$ds_name[4] = "average queue size";
$opt[4]     = "";
$def[4]     = "";

$opt[4] .= "--vertical-label \"\" -l0  --title \"$ds_name[4] for $hostname\" --units-exponent=0 ";

$def[4] .= rrd::def("var8", $RRDFILE[1], $DS[8], "AVERAGE");

$def[4] .= rrd::line2("var8", rrd::color(9), "avgqu-sz") ;
$def[4] .= rrd::gprint("var8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[4] .= rrd::comment("\\r");
$def[4] .= rrd::comment("The average queue length of the requests that were issued to the device.\\l");

#
$ds_name[5] = "await time";
$opt[5]     = "";
$def[5]     = "";

$opt[5] .= "--vertical-label \"\" -l0  --title \"$ds_name[5] for $hostname\" --units-exponent=0 ";

$def[5] .= rrd::def("var9", $RRDFILE[1], $DS[9], "AVERAGE");

$def[5] .= rrd::line2("var9", rrd::color(9), "await") ;
$def[5] .= rrd::gprint("var9", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[5] .= rrd::comment("\\r");
$def[5] .= rrd::comment("The average time (in milliseconds) for I/O requests issued to the device to be\\l");
$def[5] .= rrd::comment("served.  This  includes  the  time  spent  by the requests in queue and the\\l");
$def[5] .= rrd::comment("time spent servicing them.\\l");

#
$ds_name[6] = "service time";
$opt[6]     = "";
$def[6]     = "";

$opt[6] .= "--vertical-label \"\" -l0  --title \"$ds_name[6] for $hostname\" --units-exponent=0 ";

$def[6] .= rrd::def("var10", $RRDFILE[1], $DS[10], "AVERAGE");

$def[6] .= rrd::line2("var10", rrd::color(9), "svctm") ;
$def[6] .= rrd::gprint("var10", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[6] .= rrd::comment("\\r");
$def[6] .= rrd::comment("The average service time (in milliseconds) for I/O requests that  were  issued\\l");
$def[6] .= rrd::comment("to the device.\\l");

#
$ds_name[7] = "device utilization";
$opt[7]     = "";
$def[7]     = "";

$opt[7] .= "--vertical-label \"\" -l0  --title \"$ds_name[7] for $hostname\" --units-exponent=0 ";

$def[7] .= rrd::def("var11", $RRDFILE[1], $DS[11], "AVERAGE");

$def[7] .= rrd::line1("var11", rrd::color(3), "%util") ;
$def[7] .= rrd::gprint("var11", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[7] .= rrd::comment("\\r");
$def[7] .= rrd::comment("Percentage  of  CPU time during which I/O requests were issued to the device\\l");
$def[7] .= rrd::comment("(bandwidth utilization for the device). Device saturation occurs when this\\l");
$def[7] .= rrd::comment("value is close to 100%.\\l");

?>
