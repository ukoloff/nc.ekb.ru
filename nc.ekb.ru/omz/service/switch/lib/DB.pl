use DBI;

my $DB="$::CFG{root}/db";
-d $DB	or	mkdir $DB	or die "Cannot create '$DB'!\n";

my $z=$::CFG{db}=DBI->connect("dbi:SQLite:$DB/info.db");
if(2>=scalar $z->tables)
{
 foreach my $f(glob("$::CFG{root}/schema/*.sql"))
 {
  open F, '<', $f;
  $z->do($_)	foreach split(/;\s*\n/, join('', <F>));
  close F;
 }
}

undef $DB;

1;
