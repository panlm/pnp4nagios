<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# CPU Utilization
#
$ds_name[1] = "CPU Extension Collection";
$opt[1] = "--vertical-label Percent(%) -l0  --title \"CPU Utilization for $hostname / $servicedesc\" ";

$def[1] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
$def[1] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");

if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";       
}
$def[1] .= rrd::area("var2", rrd::color(3), "Nice") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var3", rrd::color(5), "System", "STACK") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var1", rrd::color(2), "User", "STACK") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var5", rrd::color(6), "Wait", "STACK") ;
$def[1] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::area("var4", rrd::color(7), "Idle", "STACK") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" (STACKED GRAPH)\\r");

#
# CPU Utilization
#
$ds_name[2] = "CPU Extension Collection";
$opt[2] = "--vertical-label Percent(%) -l0  --title \"CPU Utilization (No CPU Idle) for $hostname / $servicedesc\" ";

$def[2] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[2] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");
$def[2] .= rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");
#$def[2] .= rrd::def("var4", $RRDFILE[1], $DS[4], "AVERAGE");
$def[2] .= rrd::def("var5", $RRDFILE[1], $DS[5], "AVERAGE");

if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";       
}
$def[2] .= rrd::area("var2", rrd::color(3), "Nice") ;
$def[2] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::area("var3", rrd::color(5), "System", "STACK") ;
$def[2] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::area("var1", rrd::color(2), "User", "STACK") ;
$def[2] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::area("var5", rrd::color(6), "Wait", "STACK") ;
$def[2] .= rrd::gprint("var5", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
#$def[2] .= rrd::area("var4", rrd::color(7), "Idle", "STACK") ;
#$def[2] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[2] .= rrd::comment(" (STACKED GRAPH)\\r");

?>
