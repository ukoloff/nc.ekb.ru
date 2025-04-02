<?
ini_set('display_errors', true);
ini_set('log_errors', false);

require("../../lib/uxm.php");
global $CFG;
?>
<PRE>
<?
$udn=id2dn('onUserBlock');

print_r(getUsers($udn));

function getUsers($gdn)
{
 global $CFG;
 $Q[]=$gdn;
 $X[$gdn]=1;
 while(count($Q)):
  $m=getEntry($dn=array_pop($Q), 'member');
  $m=$m['member'];
  for($i=$m['count']-1; $i>=0; $i--):
   if($X[$mdn=$m[$i]]) continue;
   $X[$mdn]++;  
   if(ldap_compare($CFG->h, $mdn, 'objectClass', 'user')) $R[]=$mdn;
   if(ldap_compare($CFG->h, $mdn, 'objectClass', 'group')) $Q[]=$mdn;
  endfor;
 endwhile;
 foreach($R as $dn)
   $Q[]=dn2user($dn);
 return $Q;
}

?>