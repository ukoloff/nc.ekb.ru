<?
// Копируем фотки из домена LAN в ОМЗ
exit;	// Заблокировано до выяснения

$lan=ldap_connect('fserver');
ldap_set_option($lan, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_start_tls($lan);
ldap_bind($lan, "LAN\\".$_SERVER['PHP_AUTH_USER'], utf8($_SERVER['PHP_AUTH_PW']));

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$Q5=@mssql_pconnect('q5', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
 mssql_select_db('OMZ');

$q=ldap_search($lan, 'DC=lan,DC=uxm', '(&(objectClass=user)(jpegPhoto=*))');
for($e=ldap_first_entry($lan, $q); $e; $e=ldap_next_entry($lan, $e)):
  $u=ldap_get_values($lan, $e, 'sAMAccountName');
  $u=$u[0];
  $u2=mssql_query("Select omz From Impostors Where uxm='".strtr($u, Array("'"=>"''"))."'");
  $u2=mssql_fetch_row($u2);
  if(!$u2)$u2=$u;
  else $u2=$u2[0];
  $dn=user2dn($u2);
  if(!$dn) continue;
  if(ldap_count_entries($CFG->AD->h, ldap_read($CFG->AD->h, $dn, 'jpegPhoto=*'))) continue;
  echo "\n", $u;
  if($u<>$u2) echo "[$u2]";
  $X=ldap_get_values_len($lan, $e, 'jpegPhoto');
  unset($X['count']);
  ldap_modify($CFG->AD->h, $dn, Array('jpegPhoto'=>$X));
//  break;
endfor;
?>
