<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "Network";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"BytesPerSec\" -l0  --title \"Network for $hostname\" ";

$def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[0] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[0] .= rrd::line2("var1", rrd::color(2), "sent") ;
$def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::line2("var2", rrd::color(3), "received") ;
$def[0] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[1] = "Network";
$opt[1]     = "";
$def[1]     = "";

$opt[1] .= "--vertical-label \"PacketsPerSec\" -l0  --title \"Network for $hostname\" ";

$def[1] .= rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[4], "AVERAGE");

$def[1] .= rrd::line2("var1", rrd::color(2), "sent") ;
$def[1] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", rrd::color(3), "received") ;
$def[1] .= rrd::gprint("var2", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[2] = "Network";
$opt[2]     = "";
$def[2]     = "";

$opt[2] .= "--vertical-label \"\" -l0  --title \"Network Output Queue Length for $hostname\" ";

$def[2] .= rrd::def("var1", $RRDFILE[1], $DS[5], "AVERAGE");

$def[2] .= rrd::line2("var1", rrd::color(2), "queue") ;
$def[2] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

#
$ds_name[3] = "Network";
$opt[3]     = "";
$def[3]     = "";

$opt[3] .= "--vertical-label \"\" -l0  --title \"Network Packets Received Errors for $hostname\" ";

$def[3] .= rrd::def("var1", $RRDFILE[1], $DS[6], "AVERAGE");

$def[3] .= rrd::line2("var1", rrd::color(3), "errors") ;
$def[3] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");

?>
