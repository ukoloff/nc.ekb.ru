<?
$User='zmey';
$NasId=1;
$AH['X-TTY']='/dev/ttyS0';

if(!preg_match('|^/dev/ttyS(\\d+)$|', $AH['X-TTY'], $ttyNo)):
 Header("X-Shell: /bin/echo You're not allowed here!");
 exit;
endif;
$ttyNo=$ttyNo[1];

if(!function_exists('ldap_connect'))	dl('ldap.so');

ldapConf(); 
$CFG->udn=user2dn($User);

if(!inGroup('#dialup')):
 Header("X-Shell: /bin/echo You're not allowed to dial in!");
 exit;
endif;

$IP2=array('1$'=>'0.200', '1'=>'3.8', '2$'=>'5.200', '2'=>'5.70', '4$'=>'2.207', '4'=>'2.77');
$IP2=explode('.', $IP2[$NasId.(inGroup('#dialupGold')? '$' : '')]);
$IP2[1]+=$ttyNo;

Header("X-Shell: /usr/sbin/pppd call dialup account $User :192.168.".implode('.', $IP2));

function ldapConf()
{
 global $CFG;
 $f=fopen('/etc/ldap.conf', 'r');
 if(!$f) return;
 while(!feof($f)):
  $s=trim(preg_replace('/#.*/', '', fgets($f)));
  if(preg_match('/uri\s+(.*)/i', $s, $match))
   $URI=$match[1];
  elseif(preg_match('/binddn\s+(.*)/i', $s, $match))
   $bindDn=$match[1];
  elseif(preg_match('/bindpw\s+(.*)/i', $s, $match))
   $bindPw=$match[1];
 endwhile;
 fclose($f);
 if(!($CFG->h=ldap_connect($URI))) return;
 ldap_set_option($CFG->h, LDAP_OPT_REFERRALS, 0);
 ldap_set_option($CFG->h, LDAP_OPT_PROTOCOL_VERSION, 3);
 if(!ldap_bind($CFG->h, $bindDn, $bindPw)) return;
 $q=ldap_read($CFG->h, '', 'objectClass=*');
 if(!$q) return;
 $e=ldap_get_entries($CFG->h, $q);
 ldap_free_result($q);
 $CFG->Base=$e[0]['dn'];
}

function id2dn($id, $class='Group')
{
 global $CFG;
 if(!$id) return;
 $q=ldap_search($CFG->h, $CFG->Base, "(&(objectClass=$class)(sAMAccountName=$id))", array('1.1'));
 $e=ldap_get_entries($CFG->h, $q);
 $e=$e[0];
 ldap_free_result($q);
 return $e['dn'];
}

function user2dn($u)
{
 return id2dn($u, 'User');
}

function inGroup($g)
{
 global $CFG;
 $dn=$CFG->udn;
 if(!$dn) return;
 $gdn=id2dn($g);
 if(!$gdn) return;

 while(true):
  $q=ldap_read($CFG->h, $dn, 'objectClass=*', array('memberOf'));
  $e=ldap_get_entries($CFG->h, $q);
  ldap_free_result($q);
  $e=$e[0];
  $e=$e[$e[0]];
  for($i=$e['count']-1; $pdn=$e[$i]; $i--):
   if($pdn==$gdn) return true;
   if($dns[$pdn] or $xdns[$pdn]) continue;
   $dns[$pdn]=1;
  endfor;
  if(count($dns)<=0) break;
  reset($dns);
  $dn=key($dns);
  unset($dns[$dn]);
  $xdns[$dn]=1;  
 endwhile;
 return;
}

?>
