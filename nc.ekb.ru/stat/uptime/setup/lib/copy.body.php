<?
global $CFG;
LoadLib('/forms');
?>
<Form Action='./' Method='Post'>
<?
Input('newf', 'Имя файла');
BR();
CheckBox('force', 'Удалить, если существует');
HiddenInputs();
?>
<P /><Input Type='Submit' Value="<?=htmlspecialchars($CFG->tabs[$CFG->params->x])?> файл" />
</Form>
<Script><!--
document.forms[0].newf.focus();
//--></Script>