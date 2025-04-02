<?
$A=explode("\\", $_REQUEST[u], 2);
if(strcasecmp($A[0], $CFG->AD->Domain)) exit;
if(!strlen($A[1])) exit;
$u=AddSlashes($A[1]);
switch($_REQUEST[id])
{
 case 302: $Op='+'; break;
 case 303: $Op='-'; break;
 default:  exit;
}
$S1='Insert Into uxmJournal.TSG(Op, u, Host, IP';
$S2=")\nValues('$Op', '$u', '".AddSlashes($_REQUEST[h])."', '".AddSlashes($_REQUEST[IP])."'";
foreach(explode(' ', 't in out') as $k)
  if(strlen($_REQUEST[$k])):
   $S1.=", `$k`";
   $S2.=", ".(int)$_REQUEST[$k];
  endif;
mysql_query($S1.$S2.')');
exit;
?>