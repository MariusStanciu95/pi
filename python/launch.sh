#!/bin/sh

ps auxw | grep modbus | grep -v grep > /dev/null

if [ $? != 0 ]
then
        /etc/init.d/modbusd.sh start > /dev/null
fi
