<Style><!--
TH	{
    text-align: right;
    background: white;
}
--></Style>
<?
$e=getEntry($CFG->udn);
$d=new DN($CFG->udn);
$d->Cut();
$d=$d->ufn();
?>
<Table Border CellSpacing='0' Width='100%'>
<TR><TH>���</TH><TD><?=utf2html($e['name'][0])?><BR /></TD></TR>
<tr><th>�����</th><td><?= htmlspecialchars($d->str()) ?>
<a href=../ou/<?= htmlspecialchars(hRef('ou', $d->str(), 'u'))?>><i class="fa fa-eye"></i></a>
</td></tr>
<TR><TH>DNS</TH><TD><?=utf2html($e['dnshostname'][0])?><BR /></TD></TR>
<TR><TH>��� DNS</TH><TD><?
$ee=$e['msds-additionaldnshostname'];
for($i=$ee['count']-1; $i>=0; $i--)
  echo utf2html($ee[$i]), " ";
?><BR /></TD></TR>
<TR><TH>��</TH><TD>
<?=utf2html($e['operatingsystem'][0])?> <?=utf2html($e['operatingsystemservicepack'][0])?> v<?=utf2html($e['operatingsystemversion'][0])?>
</TD></TR>
<TR><TH>����������� �</TH><TD><?=utf2html($e['employeeid'][0])?><BR /></TD></TR>
<TR><TH>������������</TH><TD><?=utf2html($e['location'][0])?><BR /></TD></TR>
<TR><TH>��������</TH><TD><Small><?=utf2html($e['description'][0])?></Small><BR /></TD></TR>
<TR><TH>�������</TH><TD><Small><?=nl2br(utf2html($e['info'][0]))?></Small><BR /></TD></TR>

<?
setlocale(LC_ALL, "ru_RU.cp1251");

foreach(Array('������'=>'created', '������'=>'changed') as $k=>$v):
 echo "<TR><TH>$k</TH><TD>";
 $DT=utf2str($e["when$v"][0]);
 $DT=gmmktime(substr($DT, 8, 2), substr($DT, 10, 2), substr($DT, 12, 2), 
	substr($DT, 4, 2), substr($DT, 6, 2), substr($DT, 0, 4));
 echo strftime("%x %X", $DT),  "</TD></TR>\n";
endforeach;
?>
<tr><th>UPN</th><td><?= utf2html($e['userprincipalname'][0]) ?></td></tr>
<TR><TH>������</TH><TD><?
$ee=$e['serviceprincipalname'];
$eee=Array();
for($i=0; $i<$ee['count']; $i++)
  $eee[]=$ee[$i];
sort($eee);
foreach($eee as $s)
  echo "<LI>", utf2html($s);
?><BR /></TD></TR>
<!-- <TR><TH>������</TH><TD><?=utf2html($e['logoncount'][0])?><BR /></TD></TR> -->

<tr><th>�����������</th><td>
<?
$ee = $e['managedby'];
for ($i = 0; $i < $ee['count']; $i++ ):
  echo "<li>", utf2html($ee[$i]);
endfor;
?>
</Table>
