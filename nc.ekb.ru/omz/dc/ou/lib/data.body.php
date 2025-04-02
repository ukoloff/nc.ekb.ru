<Script><!--
function Valid()
{
 f=document.forms[0];
 x=f.o;
 if(!x.value) { alert('Введите название!'); x.focus(); return false;}
 return true;
}
//--></Script>
<Form Action='./' Method='POST' onSubmit='return Valid()'>
<Table><TR vAlign='Top'><TD NoWrap>
<?
LoadLib('/forms');
Input('o', 'Название');
echo "</TD><TD NoWrap>";
$CFG->defaults->Input->W=55;
#$CFG->defaults->Input->H=9;
Input('in', 'Входит в');
echo "</TD></TR></Table>
<Table><TR vAlign='Top'><TD NoWrap>";
$CFG->defaults->Input->W=40;
foreach($CFG->Fields as $k=>$v):
 if('='==$v{0}):
  echo "</TD><TD>";
  $CFG->defaults->Input->W=30;
  TextArea($k, substr($v, 1));
 else:
  Input($k, $v);
  echo "<BR />\n";
 endif;
endforeach;
if(!$CFG->odn) unset($CFG->params->ou);
hiddenInputs();
echo "<P /><Div Align='Right'>";
Submit();
echo "</Div>";
?>
</TD></TR></Table>
