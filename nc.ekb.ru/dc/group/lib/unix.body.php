<Form Action='./' Method='POST'>
<?
LoadLib('/forms');
hiddenInputs();

CheckBox('nis', '������������ � � Unix');
echo "<P>";
Input('msSFU30GidNumber', 'gid');
echo "<P>";
Submit();
?>
</Form>
