<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "SWAP Usage";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"Size(GB)\" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::cdef("cvar1", "var1,1024,/,1024,/");
$def[0] .= rrd::cdef("cvar2", "var2,1024,/,1024,/");
$def[0] .= rrd::cdef("cvar3", "cvar1,cvar2,-");

#$def[0] .= rrd::area("cvar1", rrd::color(1), "TotalSwap") ;
#$def[0] .= rrd::gprint("cvar1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::area("cvar3", rrd::color(6), "Used") ;
$def[0] .= rrd::gprint("cvar3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::area("cvar2", rrd::color(4), "Avail", "STACK") ;
$def[0] .= rrd::gprint("cvar2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment(" (STACKED GRAPH)\\r");

#
$ds_name[1] = "Memory Usage";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label Size(GB) -l0  --title \"$ds_name[1] for $hostname\" --units-exponent=0 ";

$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
#$def[1] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");
$def[1] .= rrd::def("var6", $RRDFILE[1], $DS[6], "AVERAGE");
$def[1] .= rrd::def("var7", $RRDFILE[1], $DS[7], "AVERAGE");
$def[1] .= rrd::cdef("var8", "var3,var4,-,var6,-,var7,-");

#$def[1] .= rrd::cdef("cvar3", "var3,1024,/,1024,/");
$def[1] .= rrd::cdef("cvar4", "var4,1024,/,1024,/");
#$def[1] .= rrd::cdef("cvar5", "var5,1024,/,1024,/");
$def[1] .= rrd::cdef("cvar6", "var6,1024,/,1024,/");
$def[1] .= rrd::cdef("cvar7", "var7,1024,/,1024,/");
$def[1] .= rrd::cdef("cvar8", "var8,1024,/,1024,/");

#$def[1] .= rrd::area("cvar3", rrd::color(3), "Total") ;
#$def[1] .= rrd::gprint("cvar3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("cvar8", rrd::color(3), "App") ;
$def[1] .= rrd::gprint("cvar8", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
#$def[1] .= rrd::area("cvar5", rrd::color(1), "Shared", "STACK") ;
#$def[1] .= rrd::gprint("cvar5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("cvar6", rrd::color(6), "Buffer", "STACK") ;
$def[1] .= rrd::gprint("cvar6", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("cvar7", rrd::color(2), "Cached", "STACK") ;
$def[1] .= rrd::gprint("cvar7", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("cvar4", rrd::color(4), "Avail", "STACK") ;
$def[1] .= rrd::gprint("cvar4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" (STACKED GRAPH)\\r");

#
$ds_name[2] = "Memory Utilization";
$opt[2]     = "";
$def[2]     = "";

$opt[2] .= "--vertical-label \"Percent(%)\" -l0  --title \"$ds_name[2] for $hostname\" ";

$def[2] .= rrd::def("var1", $RRDFILE[1], $DS[8], "AVERAGE");
$def[2] .= rrd::def("var2", $RRDFILE[1], $DS[9], "AVERAGE");
$def[2] .= rrd::def("var3", $RRDFILE[1], $DS[10], "AVERAGE");

$def[2] .= rrd::line2("var1", rrd::color(2), "memutil") ;
$def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var2", rrd::color(3), "actutil") ;
$def[2] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::line2("var3", rrd::color(6), "swaputil") ;
$def[2] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment(" (NO STACKED GRAPH)\\r");

?>
