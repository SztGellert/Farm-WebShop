#!/bin/bash

chmod -R 777 /cake/app/tmp

echo "Starting apache..."
/bin/sh -c "/usr/sbin/apache2ctl -D FOREGROUND"
