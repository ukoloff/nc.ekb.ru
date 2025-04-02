#!/usr/bin/perl

use strict;
use locale;
use POSIX;

setlocale(LC_ALL, "ru_RU.cp1251");

my $S='ÀÅ¨Æß';
$S.=lc($S);

my @S=split(//, $S);
foreach my $a(@S)
{
 foreach my $b(@S)
 {
  print $a, Cmp($a, $b), $b, " ";
 }
 print "\n";
}

sub Cmp
{
 my ($a,$b)=@_;
 $a=$a cmp $b;
 return '='	unless $a;
 return $a>0?'>':'<';
}