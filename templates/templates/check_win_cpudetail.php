<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$ds_name[0] = "CPU Detail Utilization";
$opt[0]     = "";
$def[0]     = "";

$opt[0] .= "--vertical-label \"%\" -l0  --title \"CPU Detail Utilization for $hostname\" ";

for($i=1;$i<=count($DS);$i++){
    $def[0] .= rrd::def("var$i", $RRDFILE[1], $DS[$i], "AVERAGE");

    if($i != count($DS)) {
        $label = $i - 1;
        $label = "cpu" . $label;
        $def[0] .= rrd::area("var$i", rrd::color($i,70), "$label", "STACK") ;
        $def[0] .= rrd::gprint("var$i", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    } else {
        # the last value is cpu total
        $label = "cpu_total";
        $def[0] .= rrd::line2("var$i", rrd::color($i), "$label") ;
        $def[0] .= rrd::gprint("var$i", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    }
}

?>
