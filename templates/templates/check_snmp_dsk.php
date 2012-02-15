<?php

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

$opt[0]     = "";
$def[0]     = "";
$myopt = "";
$string = "";

#$ds_name[3] = " File Systems: " . preg_replace('/check_snmp_dsk_/', '', $NAGIOS_SERVICEDESC);
#$opt[3]     = "--vertical-label \"Util(%)\" -l0 --title \"$ds_name[3] \" -u 100 ";
#$def[3]     = "";
#$def[3]    .= rrd::def("a$key" ,$RRDFILE[1], $DS[3], "AVERAGE");
#$def[3]    .= rrd::line2("a$key", $color_list[5], "util");
#$def[3]    .= rrd::gprint("a$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");

$ds_name[0] = " File Systems: " . preg_replace('/check_snmp_dsk_/', '', $NAGIOS_SERVICEDESC);
if ( $MAX[1] ) {
    $num = 100 / ( $MAX[1] * 1024 * 1024 ) ;
    $num2 = number_format($MAX[1]/1024,2);
    $string = $num2 . 'G';
    $myopt  .= " --right-axis $num:0 --right-axis-label \"(%)\" --base 1024 ";
}
$opt[0]     = " --vertical-label \" (bytes) \" -l0 --title \"$ds_name[0] \" " . $myopt ;
$def[0]     = "";
$def[0]    .= rrd::def("a$key" ,$RRDFILE[1], $DS[1], "AVERAGE");
$def[0]    .= rrd::def("b$key" ,$RRDFILE[1], $DS[2], "AVERAGE");
$def[0]    .= rrd::cdef("ca$key", "a$key,1024,*,1024,*");
$def[0]    .= rrd::cdef("cb$key", "b$key,1024,*,1024,*");
#$def[0]    .= rrd::gprint("ca$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
$def[0]    .= rrd::area("cb$key", $color_list[8], 'Used');
$def[0]    .= rrd::gprint("cb$key", array("MIN", "AVERAGE", "MAX"), "%.2lf%s");
$def[0]    .= rrd::line1("ca$key", $color_list[4], 'Total '.$string);
#$def[0]    .= rrd::gprint("ca$key", array("AVERAGE"), "%.2lf%s");

?>
