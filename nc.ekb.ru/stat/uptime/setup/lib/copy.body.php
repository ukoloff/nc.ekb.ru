<?
global $CFG;
LoadLib('/forms');
?>
<Form Action='./' Method='Post'>
<?
Input('newf', '��� �����');
BR();
CheckBox('force', '�������, ���� ����������');
HiddenInputs();
?>
<P /><Input Type='Submit' Value="<?=htmlspecialchars($CFG->tabs[$CFG->params->x])?> ����" />
</Form>
<Script><!--
document.forms[0].newf.focus();
//--></Script>