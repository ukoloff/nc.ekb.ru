
# Already running ?
$::CFG{db}->selectrow_arrayref("Select Count(*) From src")->[0]	and exit;

my $s=$::CFG{db}->prepare("Insert Into src(IP, host) Values(?, ?)");

while(<>)
{
 s/^s+//; s/\s+$//;
 $s->execute(split(/\s+/, $_, 2));
}

1;
