<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# Memory Utilization
#
$opt[2] = "--vertical-label Percent(%) -l0  --title \"Memory Utilization for $hostname\" ";

$def[2] = rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");

$def[2] .= rrd::area("var1", "#CCCC33", "memutil") ;
$def[2] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
