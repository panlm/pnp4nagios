<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "Pagefile Usage";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"Bytes\" -l0  --title \"$ds_name[0] for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(2), "size") ;
$def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(3), "used") ;
$def[0] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[1] = "Pagefile Utilization";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"%\" -l0  --title \"$ds_name[1] for $hostname\" -l 0 -u 100 -r ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(2), "util") ;
$def[1] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
