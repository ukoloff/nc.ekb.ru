<?
//doDebug();

function getBcc() {
  global $CFG;

  $r = ldap_search($CFG->AD->h, $CFG->odn->str(), '(&(mail=*)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))', array('mail', 'cn'));
  $ez = ldap_get_entries($CFG->AD->h, $r);
  ldap_free_result($r);

  $bcc = array();
  for ($i = $ez['count'] - 1; $i >= 0; $i--):
    $e = $ez[$i];
    $bcc[] = '"' . utf2str($e['cn'][0]) . '"<' . utf2str($e['mail'][0]) . '>';
  endfor;

  sort($bcc);
  return $bcc;
}
$bcc = getBcc();
?>
<form>
<textarea style="width: 100%" rows=27 readonly autofocus>
<?
foreach ($bcc as $rcpt):
  echo htmlspecialchars($rcpt), "\n";
endforeach;
?>
</textarea>
</form>
&raquo;
Рекомендуется помещать список адресатов в поле <b>Bcc</b>
(<b>С</b>крытая <b>К</b>опия),
а не <i>To</i>
(Кому)
или <i>Copy</i>
(Копия).
