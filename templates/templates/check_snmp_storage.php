<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$def[0] = "";
$opt[0] = "";

if ($MAX[1] != "") {
    $num = 100 / $MAX[1] ;
    $myopt = "--right-axis $num:0 --right-axis-label \"(%)\" --right-axis-format \"%.2lf\" ";
} else {
    $myopt = " ";
}

if(preg_match("/memory/i", $NAME[1])) {
    $ds_name[0] = "Physical Memory";
    $opt[0]    .= "--vertical-label \"(MB)\" -l0 --title \"$ds_name[0] ($MAX[1]MB) for $hostname\" --units-exponent=0 " . $myopt ;
    $def[0]    .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0]    .= rrd::line2("var1", rrd::color(2), "Used") ;
    $def[0]    .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    if ($WARN[1] != "") {
        $def[0]    .= rrd::hrule($WARN[1], "#FF8c00", "Warning ".$WARN[1].$UNIT[1]."\\n");
    }
    if ($CRIT[1] != "") {
        $def[0]    .= rrd::hrule($CRIT[1], "#FF0000", "Critial ");
    }
} elseif ( preg_match("/^[CDEF_].*/", $NAME[1]) ) {
    $ds_name[0] = "Disk C";
    $opt[0]    .= "--vertical-label \"(MB)\" -l0 --title \"$ds_name[0] ($MAX[1]MB) for $hostname\" --units-exponent=0 " . $myopt ;
    $def[0]    .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0]    .= rrd::line2("var1", rrd::color(3), "Used") ;
    $def[0]    .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    if ($WARN[1] != "") {
        $def[0]    .= rrd::hrule($WARN[1], "#FF8c00", "Warning ");
    }
    if ($CRIT[1] != "") {
        $def[0]    .= rrd::hrule($CRIT[1], "#FF0000", "Critial ");
    }
} else {

    include("/usr/local/groundwork/pnp/share/templates.dist/default.php");

}

?>
