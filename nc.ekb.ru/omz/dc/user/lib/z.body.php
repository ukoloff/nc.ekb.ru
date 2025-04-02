<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Input Type='Hidden' Name='imgURL' Value="<?=htmlspecialchars($CFG->entry->imgURL)?>" />
<Table x-Border Width='100%'><TR vAlign='top'>
<?
LoadLib('/forms');

//$CFG->defaults->Input->maxWidth=1;
$CFG->defaults->Input->W=31;
$CFG->defaults->Input->H=4;

$N=0;
foreach($CFG->Fields as $k=>$v):
 switch($N++)
 {
  case 5: echo "<Small>&raquo; <A hRef=# onClick='defNames(); return false;'>Установить</A> другие поля<BR />по Ф.И.О.</Small>
";
  case 10: echo "</TD>\n";
  case 0: echo "<TD NoWrap>";
 }
 if('='==$v{0}):
  TextArea($k, substr($v, 1));
 else:
  Input($k, $v);
  echo "<BR />\n";
 endif;
endforeach;
hiddenInputs();
?>
</TD></TR></Table>
<? Submit(); ?>
</Form>

