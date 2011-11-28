<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "CPU Utilization";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"%\" -l0  --title \"CPU Utilization for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");

$def[0] .= rrd::area("var1", "#CCCC33", "cpu") ;
$def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
