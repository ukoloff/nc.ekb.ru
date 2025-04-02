<Script><!--
function Sure()
{
  return confirm('Вы таки уверены?');
}
//--></Script>
<H4>Зарегистрированные IP:</H4>
<?
global $CFG;

$q=ldap_search($CFG->h, "CN=MicrosoftDNS,CN=System,".$CFG->Base, '(&(objectClass=dnsNode)(dc='.str2ldap(substr($CFG->params->u, 0, -1)).'))');
for($e=ldap_first_entry($CFG->h, $q); $e; $e=ldap_next_entry($CFG->h, $e)):
// echo "<!-- ", ldap_get_dn($CFG->h, $e), "-->";
 $x=ldap_get_values_len($CFG->h, $e, 'dnsRecord');
 for($i=$x['count']-1; $i>=0; $i--):
   echo "<LI>", join('.', unpack('C4', substr($x[$i], -4)));
 endfor;
endfor;
?>
<Center>
<Form Action='./' Method='POST'><? HiddenInputs(); ?>
Удалить запись об IP-адресах этой машины из DNS?
<P>
<Input Type='Submit' Value=' Удалить! ' onClick='return Sure()' />
</Form>
</Center>
<HR />
<Small>
&raquo;
Удаление DNS-записи - обычно безопасная операция, однако злоупотреблять ею всё же не рекомендуется.
</Small>
