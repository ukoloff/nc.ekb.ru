#!/usr/bin/perl

use strict;
use locale;
use POSIX;

my $S='Qwert �����';

print uc($S), "\n";

setlocale(LC_ALL, "ru_RU.cp1251");

print uc($S), "\n";
