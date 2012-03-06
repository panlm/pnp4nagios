<?php
#
# TCP Established
$ds_name[0] = "TCP Established";
$opt[0] = "--vertical-label \"\" -l0 --title \"$ds_name[0] for $hostname \" -Y ";

$def[0] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");

$def[0] .= rrd::area("var1", rrd::color(3), "Estab") ;
$def[0] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[0] .= rrd::comment(" ($servicedesc)\\r");

# Other TCP Connections
$ds_name[1] = "TCP Connections";
$opt[1] = "--vertical-label \"(per sec)\" -l0 --title \"$ds_name[1] for $hostname \" -Y ";

$def[1] = rrd::def("var1", $RRDFILE[1], $DS[3], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[4], "AVERAGE");
$def[1] .= rrd::def("var3", $RRDFILE[1], $DS[5], "AVERAGE");
$def[1] .= rrd::def("var4", $RRDFILE[1], $DS[6], "AVERAGE");

if ($WARN[1] != "") {
    $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
}
if ($CRIT[1] != "") {
    $def[1] .= "HRULE:$CRIT[1]#FF0000 ";       
}
$def[1] .= rrd::line2("var1", rrd::color(3), "ActiveOpensRate") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", rrd::color(5), "PassiveOpensRate") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var3", rrd::color(2), "AttemptFailsRate") ;
$def[1] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var4", rrd::color(6), "EstabResetsRate") ;
$def[1] .= rrd::gprint("var4", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::comment(" ($servicedesc)\\r");

?>
