<FieldSet>
<Legend>������
</Legend>
<Form Action='./'>
<?
LoadLib('/forms');
$CFG->defaults->Input->BR='';
CheckBox('plain', '������� ���');
Select('as', Array(''=>'�����', html=>'HTML-����', csv=>'CSV-����', txt=>'��������� ����', xls=>'���� M$ Excell', js=>'���� JSON', 'yaml'=>'YAML'));
?>
<Input Type='Submit' Value='�����!' />
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
