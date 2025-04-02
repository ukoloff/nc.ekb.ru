<?
function prettyUfn($dn, $prefix='')
{
 if(!is_a($dn, 'dn')) $dn=new dn($dn);
 $ufn=$dn->ufn();
 if('/'!=substr($ufn->str(), 0, 1)):
  $x='.';
  $xufn=new ufn('');
 else:
  $x='.';
  $xufn=new ufn('/');
 endif;
 for($i=count($xufn->X); $i>0; $i--) array_shift($ufn->X);
 echo "<Div Class='ufn'>";
 if($prefix) echo htmlspecialchars($prefix), ":\n";
 echo "<A\nhRef='../ou/'", hRef('ou', $xufn->str()), "'>", $x, "</A>";
 while($x=array_shift($ufn->X)):
  $xufn->Paste($x=$x[0]);
  echo "/";
  if(count($ufn->X)) echo "<A\nhRef='../ou/", hRef('ou', $xufn->str()), "'>";
  echo utf2html($x);
  if(count($ufn->X)) echo "</A>";
 endwhile;
 echo "</Div>\n";
}
?>
