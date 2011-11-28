<?php
# +------------------------------------------------------------------+
# |             ____ _               _        __  __ _  __           |
# |            / ___| |__   ___  ___| | __   |  \/  | |/ /           |
# |           | |   | '_ \ / _ \/ __| |/ /   | |\/| | ' /            |
# |           | |___| | | |  __/ (__|   <    | |  | | . \            |
# |            \____|_| |_|\___|\___|_|\_\___|_|  |_|_|\_\           |
# |                                                                  |
# | Copyright Mathias Kettner 2010             mk@mathias-kettner.de |
# +------------------------------------------------------------------+
#
# This file is part of Check_MK.
# The official homepage is at http://mathias-kettner.de/check_mk.
#
# check_mk is free software;  you can redistribute it and/or modify it
# under the  terms of the  GNU General Public License  as published by
# the Free Software Foundation in version 2.  check_mk is  distributed
# in the hope that it will be useful, but WITHOUT ANY WARRANTY;  with-
# out even the implied warranty of  MERCHANTABILITY  or  FITNESS FOR A
# PARTICULAR PURPOSE. See the  GNU General Public License for more de-
# ails.  You should have  received  a copy of the  GNU  General Public
# License along with GNU Make; see the file  COPYING.  If  not,  write
# to the Free Software Foundation, Inc., 51 Franklin St,  Fifth Floor,
# Boston, MA 02110-1301 USA.

$opt[1] = "--vertical-label 'CPU utilization %' -l0  -u 100 --title \"CPU Utilization for $hostname\" ";
#
$def[1] =  "DEF:user=$RRDFILE[1]:$DS[1]:AVERAGE " ;
$def[1] .= "DEF:system=$RRDFILE[2]:$DS[2]:AVERAGE " ;
$def[1] .= "DEF:wait=$RRDFILE[3]:$DS[3]:AVERAGE " ;
$def[1] .= "CDEF:us=user,system,+ ";
$def[1] .= "CDEF:sum=us,wait,+ ";
$def[1] .= "CDEF:idle=100,sum,- ";

if ($TEMPLATE[1] == "check_mk-decru_cpu")
   $thirdname = "IRQs";
else
   $thirdname = "Wait";



$def[1] .= "LINE:idle#ffffff:\"Idle\" " ;
$def[1] .= "GPRINT:idle:LAST:\"%2.1lf%%\" " ;

$def[1] .= "AREA:system#ff6000:\"System\" " ;
$def[1] .= "GPRINT:system:LAST:\"%2.1lf%%\" " ;

$def[1] .= "AREA:user#60f020:\"User\":STACK " ;
$def[1] .= "GPRINT:user:LAST:\"%2.1lf%%\" " ;

$def[1] .= "AREA:wait#00b0c0:\"$thirdname\":STACK " ;
$def[1] .= "GPRINT:wait:LAST:\"%2.1lf%%\" " ;

$def[1] .= "LINE:sum#004080:\"Utilization\" " ;
$def[1] .= "GPRINT:sum:LAST:\"%2.1lf%%\" " ;

?>
