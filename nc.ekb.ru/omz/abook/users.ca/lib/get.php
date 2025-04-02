<?
$n=(int)trim($_GET['n']);
if($n<=0) return LoadLib('list');
$CFG->params->n=$n;
LoadLib(('stas'==$CFG->u and preg_match('/^\w+$/', $_GET[key]))?'pfx':'single');
exit;
?>
