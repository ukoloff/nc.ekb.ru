<?
Header('Content-Type: text/javascript');
Header('Content-Disposition: attachment; filename="users.json"');

$s=pfxDB()->prepare("Select u, ctime, Revoke, uBy, Attrs.*".$CFG->SQL);
$x=$s->execute();
$N=0;
echo "[";
while($r=$x->fetchArray(SQLITE3_ASSOC)):
 if($N++) echo "},\n";
 $NN=0;
 echo "{";
 foreach($r as $k=>$v):
  if($NN++) echo ",\n";
  echo jsEsc($k), ': ', jsEsc($v);
 endforeach;
endwhile;
if($N) echo "}]\n";

function jsEsc($S)
{
 if(null===$S)return 'null';
 return '"'.strtr($S, Array("\n"=>"\\n", "\r"=>"\\r", "\\"=>"\\\\", '"'=>"\\\"")).'"';
}
?>
