<Form Action='./' Method='POST'>
<?
LoadLib('/forms');
hiddenInputs();

CheckBox('nis', 'Использовать и в Unix');
echo "<P>";
Input('msSFU30GidNumber', 'gid');
echo "<P>";
Submit();
?>
</Form>
