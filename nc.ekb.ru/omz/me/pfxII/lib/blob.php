<?
LoadLib('/pfx');
LoadLib('db');

$H=getallheaders();
if(!isWord($Cookie=$H['x-cookie'])) Err('Cookie/403');
if(!isWord($Ticket=$H['x-ticket'])) Err('Ticket/403');

$R=pfxCall('pfx2', $Cookie.' '.$Ticket, 0);

$u=AddSlashes($R[0]);
mysql_query("Insert Into uxmJournal.pfx(Op, IP, u) Values('g', {$CFG->IP}, '$u')");

$s=$CFG->h->prepare('Select id From H Where hash=?');
do $s->bindValue(1, $rr=R4(5)); while(@$s->execute()->fetchArray());

$s=$CFG->h->prepare('Insert Into H(idMy, hash) Values(:id, :hash)');
$s->bindValue(':id', mysql_insert_id());
$s->bindValue(':hash', $rr);
$s->execute();

Header('X-Log-Key: '.$rr);
Header('X-u: '.$R[0]);
//Header('X-ForceRO: 1');

echo $R[1], "\n";

function R4($N=1)
{
 $f=fopen('/dev/urandom', 'r');
 for($r=''; --$N>=0; $r.=$s)
  while(preg_match('/\W/', $s=base64_encode(fread($f, 3))));
 fclose($f);
 return $r;
}

function isWord($S)
{
 return preg_match('/^\w+$/', $S);
}

function Err($S)
{
 global $CFG;
 $S=AddSlashes($S);
 mysql_query("Insert Into uxmJournal.pfx(Op, IP, Error) Values('g', {$CFG->IP}, '$S')");
 Header('X-Log-Key: -');
 exit;
}

?>
