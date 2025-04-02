<?
setlocale(LC_ALL, "ru_RU.cp1251");
require('../../../lib/uxm.php');
LoadLib('/forms');

$Links=Array(
    3=>'displayName',
    7=>'cn',
    8=>'employeeID',
    90=>'givenName',
    91=>'sn',
    92=>'middleName',
);

$Cases=Array(
    ''=>'Как есть',
    'u'=>'БОЛЬШИМИ БУКВАМИ',
    'l'=>'малыми буквами',
    '1'=>'Первая буква большая',
    'w'=>'С Больших Букв',
);

function upChar($m)
{
 return strtoupper($m[0]);
}

$CFG->params->n=$CFG->entry->n=(int)trim($_REQUEST['n']);
if(!$Cases[$CFG->entry->case=trim($_REQUEST['case'])]) $CFG->entry->case='';

uxmHeader('Сотрудник');

 $Schema=$CFG->Abacus->Schema;
 $Filter=AddSlashes(strtolower($CFG->entry->q)).'%';
 $q=ociParse($CFG->oci, <<<SQL
Select N_ATR, VALUE,
 (Select Name From {$CFG->Abacus->metaSchema}.ATRIB Where N_ATR=OB.N_ATR) OName
From $Schema.OBJ_ATR_STR OB
Where N_KAT=2005 And N_OBJ=:N
SQL
);
 
// sortedHeader('ntd');
 ociBindByName($q, "N", $CFG->entry->n);
 ociExecute($q);

?>
<Table><TR><TD>
<Form Action='./' Method='GET'>
<?
//$CFG->defaults->Input->BR='';
$CFG->defaults->Input->extraAttr='onChange="this.form.submit()"';
Select('case', $Cases, 'Регистр');
unset($CFG->defaults->Input->extraAttr);
HiddenInputs();
?>
</Form>
</TD><TD Width='100%'>
<H1>Сотрудник</H1>
</TD></TR></Table>
<Form onSubmit='return false'>
<Table Border CellSpacing='0' CellPadding='0'>
<TR Class='tHeader'><TH>Атрибут</TH><TH>Значение</TH></TR>
<?
while(ociFetchInto($q, $r)):
 $v=$r[1];
 switch($CFG->entry->case)
 {
  case 'l': $v=strtolower($v); break;
  case 'u': $v=strtoupper($v); break;
  case '1': $v=ucfirst(strtolower($v)); break;
  case 'w': $v=preg_replace_callback('/(?<![[:alpha:]])[[:alpha:]]/', upChar, strtolower($v)); break;
 }
 echo "<TR><TH Align='Right'>", htmlspecialchars($r[2]?$r[2]:$r[0]), 
    "<BR /></TH>\n<TD><Input Type='CheckBox' Name='a", $r[0], "' id='i", $r[0], 
    "' Disabled />\n<Label For='i", $r[0], "'>", htmlspecialchars($v), "</Label><BR /></TD></TR>\n";
 $Attrs[$r[0]]=$v;
 if(8==$r[0]) $TabNo=$r[1];
endwhile;
if($TabNo and file_exists($_SERVER['DOCUMENT_ROOT'].($f="/img/photo/$TabNo.jpg")))
 echo "<TR><TH Align='Right'>Фото</TH><TD><Img Src='$f' Alt='Фото' /></TD></TR>";
?>
<TR><TD Align='Right'><Small><A hRef='#' onClick='DoCopy(this); return false'>Скопировать</A><BR />
отмеченные атрибуты</Small>
</TD><TD><Input Type='CheckBox' Name='all' id='ill' onClick='Mark(this)' Disabled />
<Label For='ill'>Все</Label>
</TD></TR>
</Table>
</Form>
<Script><!--
var Attrs=Array();
var Links=Array();
<?
foreach($Attrs As $k=>$v)
 echo "Attrs[", $k, "]='", AddSlashes($v), "';\n";
foreach($Links As $k=>$v)
 echo "Links[", $k, "]='$v';\n";
?>

function doEnable()
{
 var wf;
 var Ons=0;
 if(!(wf=window.opener) || !(wf=wf.document.forms) || !(wf=wf[0])) return;
 var f=document.forms[1];
 for(var i=f.length-1; i>=0; i--)
  if(f[i].type=='checkbox')
  {
   var n=f[i].name.substring(1);
   if(!Links[n]) continue;
   Ons++;
   f[i].disabled=false;
   var wi=wf[Links[n]];
   if(wi && !wi.value) f[i].checked=true;
  }
 if(Ons) f['all'].disabled=false;
}

doEnable()

function DoCopy(X)
{
 var wf;
 if(!(wf=window.opener) || !(wf=wf.document.forms) || !(wf=wf[0])) return;
 var f=document.forms[1];
 for(var i=f.length-1; i>=0; i--)
  if((f[i].type=='checkbox') && f[i].checked)
  {
   var n=f[i].name.substring(1);
   if(!Links[n]) continue;
   var wi=wf[Links[n]];
   if(wi) wi.value=Attrs[n];
   f[i].checked=false;
  }
 X.blur();
}

function Mark(X)
{
 var f=document.forms[1];
 for(var i=f.length-1; i>=0; i--)
  if((f[i].type=='checkbox') && !f[i].disabled) f[i].checked=X.checked;
}

//--></Script>
</body></html>
