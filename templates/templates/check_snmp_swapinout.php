<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
$ds_name[0] = "SWAP Usage";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"(KB)\" -l0  --title \"SWAP Usage for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(2), "SwapIn") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(3), "SwapOut") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment("\\r");
$def[0] .= rrd::comment("The average amount of memory swapped in from / out to disk\\l");

#
$ds_name[1] = "SWAP Usage";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"(blocks)\" -l0  --title \"SWAP Usage for $hostname\" --units-exponent=0 ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[4], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(2), "RawSwapIn") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", rrd::color(3), "RawSwapOut") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment("\\r");
$def[1] .= rrd::comment("Number of blocks swapped in / out\\l");

?>
