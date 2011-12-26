<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "DiskIO";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"(KB)\" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(2), "Read") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(3), "Write") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[1] = "DiskIO";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \" \" -l0  --title \"$ds_name[1] for $hostname\" --units-exponent=0 ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[4], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(2), "Read") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", rrd::color(3), "Write") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
