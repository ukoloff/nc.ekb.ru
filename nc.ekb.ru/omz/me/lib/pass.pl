#!/usr/bin/perl

use strict;
use Net::LDAP;
use MIME::Base64;
use Text::Iconv;
use Getopt::Long 2.32;
use Digest::SHA1  qw(sha1_base64);

my %Opts;

GetOptions(\%Opts, "uri=s", "dn=s", "oldpass=s", "newpass=s", "help"=>\&Help);
&Help()	unless $Opts{uri} and $Opts{dn};

my $u16=Text::Iconv->new("utf-8", "utf-16");

$Opts{$_}=decode_base64($Opts{$_})	foreach keys %Opts;

my @uri=split(/\s+/, $Opts{uri});
my $h=Net::LDAP->new(\@uri) or connectError();

ldapError($h->start_tls);

my $TmpPass=randomHash();

ldapError($h->bind($Opts{dn}, password=>$Opts{oldpass}));
ldapError(
 $h->modify($Opts{dn},
 changes=>[
    delete=>	[unicodePwd=>pass2u($Opts{oldpass})],
    add=>	[unicodePwd=>pass2u($TmpPass)]
]));

ldapError($h->bind($Opts{dn}, password=>$TmpPass));
ldapError(
 $h->modify($Opts{dn},
 changes=>[
    delete=>	[unicodePwd=>pass2u($TmpPass)],
    add=>	[unicodePwd=>pass2u($Opts{newpass})]
]));

exit 0;

sub connectError
{
 print "Ошибка подключения к контроллеру домена\n";
 exit 1;
}

sub ldapError
{
 my $msg=shift;
 my $code=$msg->code();
 return	unless($code);
 print "Ошибка $code: ", $msg->error(), "\n";
 exit 2;
}

sub Help
{
 print <<EOF;
Usage: $0 [options]
    --uri	URI(s) to connect to
    --dn	DN to connect with
    --oldpass	Password to bind with (in UTF8)
    --newpass	Password to set (in UTF8)
All options must be in Base64 encoding!
EOF
 exit;
}

sub pass2u
{
 my $S=shift;
 return substr($u16->convert('"'.$S.'"'), 2);
}

sub randomHash
{
 my $fh;
 open $fh, '<', '/dev/urandom';
 my $q;
 sysread $fh, $q, 4;
 close $fh;
 $q=sha1_base64($q);
 $q=~s/\W//g;
 return $q;
}

__END__
