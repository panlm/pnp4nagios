<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#

$color_list = array(
    1 => "#ff77ee", // Purple
    2 => "#fed409", // Yellow
    3 => "#007dd0", // Blue
    4 => "#ee0a04", // Red
    5 => "#56a901", // Green
    6 => "#ff6600", // Orange
    7 => "#a4a4a4", // Grey
    8 => "#336633"  // darker green
);

if(preg_match('/^ProcessorLoad$/', $NAME[1])) {
    $ds_name[0] = "Processor Load";
    $def[0] = "";
    $opt[0] = "--vertical-label \"%\" -l0  --title \"$ds_name[0] for $hostname\" ";
    $def[0] .= rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0] .= rrd::line2("var1", rrd::color(2), "average") ;
    $def[0] .= rrd::gprint("var1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
} elseif (preg_match('/^p[0-9]+/', $NAME[1])) {
    #graph 1
    $ds_name[0] = "Processor Load";
    $def[0] = "";
    $opt[0] = "--vertical-label \"%\" -l0  --title \"$ds_name[0] for $hostname\" ";
    for($i=1;$i<=count($DS);$i++){
        $def[0] .= rrd::def("var$i", $RRDFILE[1], $DS[$i], "AVERAGE");
        $def[0] .= rrd::cdef("cvar$i", "var$i,8,/");
        $label = $i - 1;
        $label = "cpu" . $label;
    #    $def[0] .= rrd::line1("cvar$i", $color_list[$i]."FF", "$label", "STACK") ;
        $def[0] .= rrd::area("cvar$i", $color_list[$i]."ff", "$label", "STACK") ;
        $def[0] .= rrd::gprint("var$i", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    }

    #graph 2
    $ds_name[1] = "Processor Load";
    $def[1] = "";
    $opt[1] = "--vertical-label \"%\" -l0  --title \"$ds_name[0] for $hostname\" ";
    for($i=1;$i<=count($DS);$i++){
        $def[1] .= rrd::def("cvar$i", $RRDFILE[1], $DS[$i], "AVERAGE");
    #    $def[1] .= rrd::cdef("cvar$i", "var$i,8,/");
        $label = $i - 1;
        $label = "cpu" . $label;
        $def[1] .= rrd::line1("cvar$i", $color_list[$i]."FF", "$label") ;
    #    $def[1] .= rrd::area("cvar$i", $color_list[$i]."32", "$label") ;
        $def[1] .= rrd::gprint("cvar$i", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    }
} else {

    include("/usr/local/groundwork/pnp/share/templates.dist/default.php");

}


?>
