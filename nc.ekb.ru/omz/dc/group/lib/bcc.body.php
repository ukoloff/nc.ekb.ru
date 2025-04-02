<?
#doDebug();

function getBcc() {
  global $CFG;
  $seen = Array();
  $bcc  = Array();
  $queue = Array($CFG->gdn);
  while (count($queue)):
    $e = getEntry(array_pop($queue), 'member mail cn sAMAccountName userAccountControl');
    if (!$e['samaccountname'][0] || $e['useraccountcontrol'] & uac_ACCOUNTDISABLE || $seen[$e['samaccountname'][0]]) continue;
    $seen[$e['samaccountname'][0]] = 1;
    if ($e['mail'][0]) {
      $bcc[] = '"' . utf2str($e['cn'][0]) . '"<' . utf2str($e['mail'][0]) . '>';
    }
    $ms = $e['member'];
    for ($i = $ms['count'] - 1; $i >= 0; $i--):
      $queue[] = $ms[$i];
    endfor;
  endwhile;
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
