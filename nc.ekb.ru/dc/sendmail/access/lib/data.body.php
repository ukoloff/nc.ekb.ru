<?
LoadLib('/forms');
?>
<Form Action='./' Method='POST'>
<?
$CFG->defaults->Input->W=40;
Input('cn', '��������');
BR();
Input('up', '������������');
BR();
Input('description', '��������');
BR(); BR();
HiddenInputs();
Submit();
?>
</Form>
