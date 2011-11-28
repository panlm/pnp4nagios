<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "CPU Detail Utilization";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"%\" -l0  --title \"CPU Detail Utilization for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
$def[0] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[0] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
$def[0] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");

$def[0] .= rrd::line1("var1", rrd::color(1), "cpu0") ;
$def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line1("var2", rrd::color(2), "cpu1") ;
$def[0] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line1("var3", rrd::color(3), "cpu2") ;
$def[0] .= rrd::gprint("var3", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line1("var4", rrd::color(4), "cpu3") ;
$def[0] .= rrd::gprint("var4", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line1("var5", rrd::color(5), "cputotal") ;
$def[0] .= rrd::gprint("var5", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
