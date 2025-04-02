<?
$r=mysql_fetch_array(mysql_query('SELECT sha1(zone) FROM uxmJournal.dns Order By ctime Desc Limit 1'));
$r=$r[0];

function getZone(&$T)
{
 $R='';
 if($T->RRs)
  foreach($T->RRs as $r)
    $R.="$T->path\t$r->RR\t$r->Value\n";
 if($T->sub)
  foreach($T->sub as $r)
   $R.=getZone($r);
 return $R;
}

$S=getZone($CFG->Tree);
if(sha1($S)==$r) return;

mysql_query("Insert Into uxmJournal.dns(zone) Values('".AddSlashes($S)."')");
?>
