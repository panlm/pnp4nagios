<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#

require('color.php');

$ds_name[0] = "Average Load (laload)";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \" \" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
$def[0] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");

$def[0] .= rrd::area("var1", $color_list[1]."32", "1min") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", $color_list[1]."ff", "5min") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var3", $color_list[3]."ff", "15min") ;
$def[0] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
