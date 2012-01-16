<?php
#
# Copyright (c) 2006-2010 Joerg Linge (http://www.pnp4nagios.org)
#
$def[0] = "";
$opt[0] = "";

$myopt = " --base=1024 ";

if ($MAX[1] != "") {
    $num = 100 / ( $MAX[1] * 1024 * 1024 );
    $myopt .= "--right-axis $num:0 --right-axis-label \"(%)\" --right-axis-format \"%.2lf\" ";
} else {
    $myopt .= " ";
}

if(preg_match("/memory/i", $NAME[1])) {
    $ds_name[0] = "Physical Memory";
    $pct        = number_format($ACT[1] / $MAX[1] * 100,2);
    $opt[0]    .= "--vertical-label \"(byte)\" -l0 --title \"$ds_name[0] (Used:$pct%) for $hostname\" " . $myopt ;
    $def[0]    .= rrd::def("cvar1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0]    .= rrd::cdef("var1", "cvar1,1024,*,1024,*");
    $def[0]    .= rrd::line2("var1", rrd::color(2), "Used(".$UNIT[1].") ") ;
    $def[0]    .= rrd::gprint("cvar1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    $def[0]    .= rrd::comment("  Total    - ".$MAX[1]." ".$UNIT[1]."   ");
    if ($WARN[1] != "") {
        $warn = $WARN[1] * 1024 * 1024 ;
        $warnpct = number_format($WARN[1] / $MAX[1] * 100,0);
        $def[0]    .= rrd::hrule($warn, "#FF8c00", "Warning  - ".$WARN[1]." ".$UNIT[1]." ".$warnpct."%   ");
    }
    if ($CRIT[1] != "") {
        $crit = $CRIT[1] * 1024 * 1024 ;
        $critpct = number_format($CRIT[1] / $MAX[1] * 100,0);
        $def[0]    .= rrd::hrule($crit, "#FF0000", "Critical - ".$CRIT[1]." ".$UNIT[1]." ".$critpct."%   ");
    }
} elseif ( preg_match("/^[CDEF_].*/", $NAME[1]) ) {
    if ( preg_match("/^_vmfs_volumes_/", $NAME[1]) ) {
        $tmp_str = str_replace("_vmfs_volumes_","",$NAME[1]);
        if ( preg_match("/4e937456-b2534ed8-bd87-782bcb5b24f0/", $tmp_str) ) {
            $ds_name[0] = "esxi01store";
        } elseif ( preg_match("/4e98dc1b-748d04f2-887a-782bcb5b24ef/", $tmp_str) ) {
            $ds_name[0] = "sanstore1";
        } elseif ( preg_match("/4e93776b-73bdd41e-c754-782bcb5b2935/", $tmp_str) ) {
            $ds_name[0] = "esxi02store";
        } elseif ( preg_match("/4e98dc1b-748d04f2-887a-782bcb5b24ef/", $tmp_str) ) {
            $ds_name[0] = "sanstore1";
        } elseif ( preg_match("/4e94758b-ea2216be-4306-782bcb5b23bb/", $tmp_str) ) {
            $ds_name[0] = "esxi11store";
        } elseif ( preg_match("/4eb4cbed-02a37fc8-b9dc-782bcb5b26df/", $tmp_str) ) {
            $ds_name[0] = "sanstore2";
        } elseif ( preg_match("/4e946595-9d13edb8-11b7-782bcb5b26e0/", $tmp_str) ) {
            $ds_name[0] = "esxi12store";
        } elseif ( preg_match("/4eb4cbed-02a37fc8-b9dc-782bcb5b26df/", $tmp_str) ) {
            $ds_name[0] = "sanstore2";
        } else {
            $ds_name[0] = "default";
        }
    } else {
        $ds_name[0] = str_replace("_","/",preg_replace("/__[^_]*$/","",$NAME[1]));
    }
    $pct        = number_format($ACT[1] / $MAX[1] * 100,2);
    $opt[0]    .= "--vertical-label \"(byte)\" -l0 --title \"$ds_name[0] (Used:$pct%) for $hostname\" " . $myopt ;
    $def[0]    .= rrd::def("cvar1", $RRDFILE[1], $DS[1], "AVERAGE");
    $def[0]    .= rrd::cdef("var1", "cvar1,1024,*,1024,*");
    $def[0]    .= rrd::line2("var1", rrd::color(3), "Used(MB)") ;
    $def[0]    .= rrd::gprint("cvar1", array("MIN", "AVERAGE", "MAX"), "%6.2lf");
    $def[0]    .= rrd::comment("  Total    - ".$MAX[1]." ".$UNIT[1]."   ");
    if ($WARN[1] != "") {
        $warn = $WARN[1] * 1024 * 1024 ;
        $warnpct = number_format($WARN[1] / $MAX[1] * 100,0);
        $def[0]    .= rrd::hrule($warn, "#FF8c00", "Warning  - ".$WARN[1]." ".$UNIT[1]." ".$warnpct."%   ");
    }
    if ($CRIT[1] != "") {
        $crit = $CRIT[1] * 1024 * 1024 ;
        $critpct = number_format($CRIT[1] / $MAX[1] * 100,0);
        $def[0]    .= rrd::hrule($crit, "#FF0000", "Critical - ".$CRIT[1]." ".$UNIT[1]." ".$critpct."%   ");
    }
} else {

    include("/usr/local/groundwork/pnp/share/templates.dist/default.php");

}

?>
