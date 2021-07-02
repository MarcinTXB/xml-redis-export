#!/bin/bash

PHP=`which php`

if [ "$#" -gt 2 ] ; then
    echo "Za dużo parametrów."
elif [ "$#" -eq 2 ] ; then
    if [ "$1" == "-v" ] ; then
        $PHP index.php $1 $2
    else
        echo "Nieznany parametr: $1"
    fi
elif [ "$#" -eq 1 ] ; then
    $PHP index.php $1
else
    echo "Podaj jako parametr ścieżkę do pliku xml."
fi



