<?
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: inline; filename="'.$CFG->params->u.'.json"');

foreach(explode(' ', 
 'userCertificate mSMQSignCertificates objectSid sIDHistory thumbnailPhoto msExchSafeSendersHash msExchMailboxGuid msExchMailboxSecurityDescriptor') as $a)
 $XA[$a]=1;

$q=ldap_read($CFG->AD->h, $CFG->udn, 'objectClass=user');
$e=ldap_first_entry($CFG->AD->h, $q);
if(!$e):
  Header('HTTP/1.0 404');
  exit;
endif;
echo "{'dn': ", jsEscape(utf2str($CFG->udn)), ",\n'Groups': [";
$i=0;
foreach(getGroups() As $k=>$v):
 if($i++) echo ",\n\t";
 echo "{l: $v, g: ", jsEscape(utf2str(dn2user($k))), ", dn: ", jsEscape(utf2str($k)), "}";
endforeach;
echo "]";
for($a=ldap_first_attribute($CFG->AD->h, $e, $ber); $a; $a=ldap_next_attribute($CFG->AD->h, $e, $ber))
 if(!$XA[$a]) $A[]=$a;
sort($A);
foreach($A as $a):
 echo ",\n", jsEscape($a), ": [";
 $v=ldap_get_values($CFG->AD->h, $e, $a);
 for($i=0; $i<$v[count]; $i++):
  if($i) echo ",\n\t";
  echo jsEscape(utf2str($v[$i]));
 endfor;
 echo "]";
endforeach;
echo "}\n";

function getGroups()
{
 global $CFG;
 $R=Array();
 $Q[]=$CFG->udn;
 while($dn=array_shift($Q)):
  $N=1+$R[$dn];
  $e=getEntry($dn, 'memberOf');
  $e=$e[$e[0]];
  for($i=$e[count]-1; $i>=0; $i--)
   if(!$R[$e[$i]]):
    $R[$e[$i]]=$N;
    $Q[]=$e[$i];
   endif;
 endwhile;
 return $R;
}
?>
