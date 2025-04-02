#!/usr/bin/perl

use strict;

$|=1;
$ENV{PATH}='/bin/';
delete @ENV{'IFS', 'CDPATH', 'ENV', 'BASH_ENV'};

my $EXE='/sbin/ip';

system $EXE, qw(rule del pri 50000);
system $EXE, qw(rule add pri 50000 from all lookup), unTaint($ARGV[0]);
system $EXE, qw(route flush cache);

sub unTaint
{
 my %X;
 $X{shift()}=0;
 return (keys %X)[0];
}

__END__
