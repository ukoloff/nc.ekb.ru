<?
Header('Content-Type: application/vnd.ms-excel');
Header('Content-Disposition: attachment; filename="'.$CFG->params->g.'-'.strftime('%Y-%m-%d').'.xls"');

$classes = array("group"=>1, "user"=>3, "computer"=>2);

unset($top);
$top->ch = array();
unset($q0);
$q0->dn = $CFG->gdn;
$q0->in = $top;
$queue = array($q0);
$seen = array();
while (count($queue)):
  $q0 = array_pop($queue);
  $e = getEntry($q0->dn, 'member mail cn title sAMAccountName userAccountControl objectClass');
  $login = $e['samaccountname'][0];
  if (!$login || $seen[$login]) continue;
  $seen[$login] = 1;
  unset($me);
  $me->login = $login;
  $me->mail = $e['mail'][0];
  $me->cn = $e['cn'][0];
  $me->title = $e['title'][0];
  $me->uac = $e['useraccountcontrol'][0];
  $me->klass = end($e['objectclass']);
  $me->k = $classes[$me->klass];
  if(!$me->k) $me->k = 100;
  $dn = new dn($e['dn']);
  $dn->Cut();
  $me->ufn = utf8($dn->ufn()->str());
  $me->ch = array();
  $q0->in->ch[] = $me;
  $ms = $e['member'];
  if (!$ms) continue;
  for ($i = $ms['count'] - 1; $i >= 0; $i--):
    unset($q1);
    $q1->dn = $ms[$i];
    $q1->in = $me;
    $queue[] = $q1;
  endfor;
endwhile;

function cmpAD($a, $b) {
  if ($a->k < $b->k) return -1;
  if ($a->k > $b->k) return +1;
  if ($a->cn < $b->cn) return -1;
  if ($a->cn > $b->cn) return +1;
  return 0;
}

function xls($z, $level=0) {
  usort($z->ch, "cmpAD");
  foreach($z->ch as $x):
    $style = 'mso-outline-parent:collapsed;';
    if ($level > 0)
      $style .= "mso-outline-level:$level;";
    if ($level > 1)
      $style .= "display:none;";
    $dis = $x->uac & uac_ACCOUNTDISABLE ? '#' : '';
    echo "<tr style=\"$style\"><td>",
      $level ? $level : '', "</td><td>",
      $x->klass[0], "</td><td>",
      $dis, "</td><td>",
      $dis ? "<s>" : "",
      htmlspecialchars($x->cn), $dis ? "</s>" : "", "</td><td>",
      htmlspecialchars($x->ufn), "</td><td>",
      htmlspecialchars($x->login), "</td><td>",
      htmlspecialchars($x->mail), "</td><td>",
      htmlspecialchars($x->title),
      "</td></tr>\n";
    xls($x, $level+1);
  endforeach;
}
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns="http://www.w3.org/TR/REC-html40">
<head>
<!--[if gte mso 9]><xml>
<x:ExcelWorkbook>
<x:ExcelWorksheets>
<x:ExcelWorksheet>
<x:Name><?= utf8($CFG->params->g) ?></x:Name>
<x:WorksheetOptions>
<x:NoSummaryRowsBelowDetail/>
<x:NoSummaryColumnsRightDetail/>
</x:WorksheetOptions>
</x:ExcelWorksheet>
</x:ExcelWorksheets>
</x:ExcelWorkbook>
</xml><![endif]-->
<meta http-equiv="Content-Type" content='text/html; charset=utf-8' />
<style>
td {
  white-space: nowrap;
}
</style>
</head><body>
<table>
<tr>
<th>#</th>
<th>?</th>
<th>-</th>
<th>cn</th>
<th>/</th>
<th>login</th>
<th>mail</th>
<th>title</th>
</tr>
<?
xls($top);
?>
</table></body></html>
<?
//print_r($top);
//print_r($seen);
exit();
?>
