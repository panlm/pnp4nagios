<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
# Plugin: check_load
#
# Disk
#
$fsname = ereg_replace(".rrd","",ereg_replace(".*_","",$RRDFILE[1]));
$ds_name[1] = $hostname . ":" . $fsname;
$opt[1] = "--vertical-label DISK(MB) -l0  --title \"Disk Usage for fs:\"" . $fsname;

$def[1] = rrd::def("var1", $RRDFILE[1], $DS[1], "AVERAGE");
$def[1] .= rrd::def("var2", $RRDFILE[1], $DS[2], "AVERAGE");

$def[1] .= rrd::line2("var1", "#CCCC33", "Disksize") ;
$def[1] .= rrd::gprint("var1", array("LAST", "AVERAGE", "MAX"), "%6.2lf");
$def[1] .= rrd::line2("var2", "#33FFFF", "DiskUsed") ;
$def[1] .= rrd::gprint("var2", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

#
# Disk Utilization
#
$ds_name[2] = $hostname . ":" . $fsname;
$opt[2] = "--vertical-label DiskUtil(%) -l0  --title \"Disk Utilization for fs:\"" . $fsname;

$def[2] = rrd::def("var3", $RRDFILE[1], $DS[3], "AVERAGE");

$def[2] .= rrd::line2("var3", "#336666", "DiskUtil") ;
$def[2] .= rrd::gprint("var3", array("LAST", "AVERAGE", "MAX"), "%6.2lf");

?>
