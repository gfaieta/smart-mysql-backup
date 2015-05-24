#!/bin/bash


# Jump to backup dir
MYDIR="$( cd "$( dirname "$0" )" && pwd )"
cd $MYDIR

rm -f tablelist
make backup

