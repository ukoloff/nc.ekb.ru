<FieldSet>
<Legend>Формат
</Legend>
<Form Action='./'>
<?
LoadLib('/forms');
$CFG->defaults->Input->BR='';
CheckBox('plain', 'Плоский вид');
Select('as', Array(''=>'Экран', html=>'HTML-файл', csv=>'CSV-файл', txt=>'Текстовый файл', xls=>'Файл M$ Excell', js=>'Файл JSON', 'yaml'=>'YAML'));
?>
<Input Type='Submit' Value='Давай!' />
</Form>
</FieldSet>
<?
if($CFG->entry->plain):
 LoadLib('asdb');
 echo "<PRE>";
 tree2text($CFG->Tree);
 echo "</PRE>";
else:
 LoadLib('ashtml');
 tree2html($CFG->Tree);
endif;

?>
