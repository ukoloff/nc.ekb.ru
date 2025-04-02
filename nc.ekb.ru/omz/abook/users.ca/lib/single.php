<?
$s=pfxDB()->prepare('Select u, BLOB From Certs Where id=:n');
$s->bindValue(':n', $CFG->params->n);
$r=$s->execute()->fetchArray();
if(!$r):
 Header('HTTP/1.0 404');
 exit;
endif;

$u=$r[u];
if(!$u)$u='x509';
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: attachment; filename="'.$u.'.cer"');
echo $r[BLOB];

?>
