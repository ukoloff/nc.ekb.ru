<?
LoadLib('/forms');
?>
<Form Action='./' Method='POST'>
<?
$CFG->defaults->Input->W=40;
Input('cn', 'Название');
BR();
Input('up', 'Расположение');
BR();
Input('description', 'Описание');
BR(); BR();
HiddenInputs();
Submit();
?>
</Form>
