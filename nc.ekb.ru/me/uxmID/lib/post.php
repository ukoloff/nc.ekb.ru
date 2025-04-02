<?
# Выдача результата авторизации и данных о юзвере
global $CFG;

$q=sqlite3_query($CFG->db, "Select u, n From Auth Where i=".sqlite3_escape($_POST['i']));
$x=sqlite3_fetch($q);
sqlite3_query_close($q);

$u=$x[0];
$n=$x[1];

$dn='';
if(strlen($u))$dn=user2dn($u);
if(!strlen($dn)) $u='';

echo "u=", xEscape($u), "\nn=", xEscape($n), "\ndn=", xEscape(utf2str($dn)), 
    "\ng=", xEscape(arrEscape(getGroups($dn))),
    "";

// Удалить запись об авторизации
sqlite3_exec($CFG->db, "Delete From Auth Where i=".sqlite3_escape($_POST['i']));

function xEscape($S, $char="\n")
{
 return preg_replace('/([\\\\'.$char.'])/', '\\\\$1',$S);
}

function getGroups($dn)
{
 if(!strlen($dn)) return;
 $Level=0;
 $DNs=Array();
 $List=Array();
 while(1):
  $e=getEntry($dn, 'memberOf'.($Level? ' sAMAccountName':''));
  if($Level) $DNs[$dn][id]=utf2str($e['samaccountname'][0]);
  $e=$e['memberof'];
  for($i=$e['count']-1; $i>=0; $i--):
   $gdn=$e[$i];
   if($DNs[$gdn]) continue;
   $DNs[$gdn]=Array(Level=>$Level+1);
   $List[]=$gdn;
  endfor;
  if(!count($List)) break;
  $dn=array_shift($List);
  $Level=$DNs[$dn][Level];
 endwhile;
 $Res=Array();
 foreach($DNs as $k=>$v)
   $Res[$v[id]]=$v[Level];
 return $Res;
}

function arrEscape(&$Array)
{
 $S='';
 foreach($Array as $k=>$v)
 $S.=xEscape($k, "=").'='.xEscape($v)."\n";
 return $S;
}

?>
