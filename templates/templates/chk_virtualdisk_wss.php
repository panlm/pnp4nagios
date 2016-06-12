<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#

require('color.php');

$ds_name[0] = "Read/Write Working Set Size (in 2 minutes)";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \" \" -l0  --title \"$ds_name[0] for $hostname\" --units-exponent=0 ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::area("var1", $color_list[1]."ff", "read_2min(MB)") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", $color_list[3]."ff", "write_2min(MB)") ;
$def[0] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

$ds_name[1] = "Read/Write Working Set Size (in 1 hour)";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \" \" -l0  --title \"$ds_name[1] for $hostname\" --units-exponent=0 ";

$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");

$def[1] .= rrd::area("var3", $color_list[1]."ff", "read_1hr(MB)") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var4", $color_list[3]."ff", "write_1hr(MB)") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
