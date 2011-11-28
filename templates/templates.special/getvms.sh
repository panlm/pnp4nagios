#!/bin/bash

fn=$(find /tmp -name "$1" -mmin -5)
if [ -z $fn ]; then
    /usr/local/groundwork/nagios/libexec/check_esx3_gw.pl  -H $1 -C yinjicomm -l LIST >/tmp/$1
fi

cat /tmp/$1 |grep -e ent -e isv |grep -oE '[^ ]*\(UP\)' |xargs |sed -e 's/(UP)//g' -e 's/ /|/g'







