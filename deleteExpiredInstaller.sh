#! /usr/bash
find /var/www/html/installpy/* -type f -mmin +60 -exec rm -f {} \;
