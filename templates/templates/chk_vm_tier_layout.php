<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#

require('color.php');

$ds_name[0] = "Tier Layout for";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \" \" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", $color_list[4]."ff", "SSD Usage (MB)") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", $color_list[3]."ff", "HDD Usage (MB)") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

