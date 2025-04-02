<? //New CA (SQLite) access
LoadLib('/pfx');

$n=preg_match('/\d+/', $_GET['cer'], $n)?$n[0]:'.';

$h=pfxDB();
$s=$h->prepare("Select * From Certs Where u=:u ".('.'==$n? "Order By Revoke, ctime Desc" : "And id=:n"));
if('.'!=$n) $s->bindValue(':n', $n);
$s->bindValue(':u', $CFG->params->u);
$r=$s->execute()->fetchArray();
if(!$r):
 Header('HTTP/1.0 404');
 exit;
endif;

Header('Content-Type: application/octet-stream');
Header('Content-Disposition: inline; filename="'.$CFG->params->u.'.cer"');
echo $r[BLOB];

?>
