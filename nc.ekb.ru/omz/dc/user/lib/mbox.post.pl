#!/usr/bin/perl 

use strict;
use MIME::Base64;

$|=1;
$ENV{PATH}='/bin/';
delete @ENV{'IFS', 'CDPATH', 'ENV', 'BASH_ENV'};

#open F, '+<', '/var/www/virts/ssl-ekb.ru/omz/dc/user/lib//mbox.test';
open F, '+<', '/etc/mail/aliases';
seek(F, -1, 2);
print F "\n"	unless getc(F)=~/[\n\r]/;
print F decode_base64(unTaint($ARGV[0])), "\n";
close F;

exec '/usr/bin/newaliases';

sub unTaint
{
 my %X;
 $X{shift()}=0;
 return (keys %X)[0];
}

__END__
