#!/bin/bash

cd  ~/temp2/

for fn in `cat ../temp/$1`; do
	temp=`sed 's/[/]//' $1`
	sudo mv $temp $fn
done
