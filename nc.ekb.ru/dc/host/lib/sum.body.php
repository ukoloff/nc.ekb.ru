<Style><!--
TH	{
    text-align: right;
    background: white;
}
--></Style>
<?
global $CFG;
$e=getEntry($CFG->udn);
?>
<Table Border CellSpacing='0' Width='100%'>
<TR><TH>Имя</TH><TD><?=utf2html($e['name'][0])?><BR /></TD></TR>
<TR><TH>DNS</TH><TD><?=utf2html($e['dnshostname'][0])?><BR /></TD></TR>
<TR><TH>Ещё DNS</TH><TD><?
$ee=$e['msds-additionaldnshostname'];
for($i=$ee['count']-1; $i>=0; $i--)
  echo utf2html($ee[$i]), " ";
?><BR /></TD></TR>
<TR><TH>ОС</TH><TD>
<?=utf2html($e['operatingsystem'][0])?> <?=utf2html($e['operatingsystemservicepack'][0])?> v<?=utf2html($e['operatingsystemversion'][0])?>
</TD></TR>
<TR><TH>Расположение</TH><TD><?=utf2html($e['location'][0])?><BR /></TD></TR>
<TR><TH>Описание</TH><TD><Small><?=utf2html($e['description'][0])?></Small><BR /></TD></TR>

<?
setlocale(LC_ALL, "ru_RU.cp1251");

foreach(Array('Создан'=>'created', 'Изменён'=>'changed') as $k=>$v):
 echo "<TR><TH>$k</TH><TD>";
 $DT=utf2str($e["when$v"][0]);
 $DT=gmmktime(substr($DT, 8, 2), substr($DT, 10, 2), substr($DT, 12, 2), 
	substr($DT, 4, 2), substr($DT, 6, 2), substr($DT, 0, 4));
 echo strftime("%x %X", $DT),  "</TD></TR>\n";
endforeach;
?>
<TR><TH>Службы</TH><TD><?
$ee=$e['serviceprincipalname'];
$eee=Array();
for($i=0; $i<$ee['count']; $i++)
  $eee[]=$ee[$i];
sort($eee);
foreach($eee as $s)
  echo "<LI>", utf2html($s);
?><BR /></TD></TR>
<!-- <TR><TH>Входов</TH><TD><?=utf2html($e['logoncount'][0])?><BR /></TD></TR> -->

</Table>

<? 
if(0 and 'stas'==$CFG->u):
 echo "<PRE>";
 print_r($e);
endif;
?>