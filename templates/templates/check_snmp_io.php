<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "IO Utilization";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"blocks\" -l0  --title \"SWAP Usage for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(1), "IOSent") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(4), "IOReceive") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
