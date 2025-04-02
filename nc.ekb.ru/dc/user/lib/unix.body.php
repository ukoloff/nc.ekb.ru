<Form Action='./' Method='POST'>
<?
LoadLib('/forms');

hiddenInputs();
$N=0;
foreach($CFG->Fields as $k=>$v):
 Input($k, $v);
 echo "<BR />\n";
endforeach;
BR();
Submit();
?>
</Form>
