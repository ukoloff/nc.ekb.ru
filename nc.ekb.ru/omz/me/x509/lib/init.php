<?
header('Content-Type: application/x-javascript');
header('Expires: 0');
$callback=trim($_GET[callback]);

echo $callback?$callback:'X509', '(';

LoadLib('/pfx');
$s=pfxDB()->prepare("Select * From Certs, Attrs Where Certs.id=Attrs.id And serial=?");
$s->bindValue(1, $_SERVER[SSL_CLIENT_M_SERIAL]);
$q=$s->execute();
while($r=$q->fetchArray()):
 if(preg_replace('/\S+/', '', $_SERVER[SSL_CLIENT_CERT])!=preg_replace('/\S+/', '', $r[BLOB])) continue;
 echo "{\n id: ", jsEscape($r[id]),
    ",\n u: ", jsEscape($r[u]),
    ",\n s: ", jsEscape($r[serial]),
    ",\n revoke: ", jsEscape($r[Revoke]),
    ",\n DN: ", jsEscape($r[subj]), "\n}";
 break;
endwhile;
echo ');';
exit;
?>
