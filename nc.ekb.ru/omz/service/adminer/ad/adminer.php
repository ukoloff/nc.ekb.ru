<PRE><?
//setlocale(LC_ALL, "ru_RU.cp1251");

function A12($user, $pass)
{
 if(!strlen($user) or !strlen($pass)) return;
 $DC='OMZGLOBAL';
 for($i=5; $i>0; $i--)
   if($h=ldap_connect($DC)
    and ldap_set_option($h, LDAP_OPT_REFERRALS, 0)
    and ldap_set_option($h, LDAP_OPT_PROTOCOL_VERSION, 3)
    and ldap_start_tls($h)):
	if(!ldap_bind($h, $DC."\\".$user, $pass)) return;
	$ad=$h;
	break;
   endif;
 if(!$ad) return;

 $q=ldap_search($ad, 'DC=omzglobal,DC=com', '(&(objectCategory=user)(sAMAccountName='.AddCSlashes($user, "\\()*=").'))', Array('1.1'));
 if(!$q or 1!=ldap_count_entries($ad, $q)) return;
 $Q[]=$dn=ldap_get_dn($ad, ldap_first_entry($ad, $q));
 $X[$dn]=1;

 while($dn=array_shift($Q)):
  $l=$X[$dn];
  $q=ldap_read($ad, $dn, 'objectClass=*', Array('sAMAccountName', 'memberOf'));
  if(!$q or 1!=ldap_count_entries($ad, $q)) continue;
  $q=ldap_first_entry($ad, $q);
  $x=ldap_get_values($ad, $q, 'sAMAccountName');
  $G[$x[0]]=$l++;
  $x=ldap_get_values($ad, $q, 'memberOf');
  for($i=$x[count]-1; $i>=0; $i--):
   if($X[$dn=$x[$i]]) continue;
   $X[$dn]=$l;
   $Q[]=$dn;
  endfor;
 endwhile;
 return $G;
}

print_r(A12($_SERVER[PHP_AUTH_USER], $_SERVER[PHP_AUTH_PW]));
?>
