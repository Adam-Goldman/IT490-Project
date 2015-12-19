#!/bin/bash

for fn in `cat $1`; do 
	temp=`sed 's/[/]//' $1`
	sudo mv $temp $fn
done
