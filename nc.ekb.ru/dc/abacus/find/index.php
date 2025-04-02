<?
require('../../../lib/uxm.php');
LoadLib('/forms');

uxmHeader('Поиск сотрудника');
?>
<Script><!--
function Validate()
{
 var q=document.forms[0].q;
 if(q.value) return true;
 q.focus();
 return false;
}

function Click(No)
{
 var s=window.Txt[No];
 if(!s) return;
 var f=document.forms[0];
 f.as.value='eq';
 f.q.value=s;
 f.q.focus();
}

function htmlEsc(s)
{
 var X='<lt,>gt,"quot,&amp'.split(',');
 for(var i=X.length-1; i>=0; i--)
  s=s.split(X[i].substring(0, 1)).join("&"+X[i].substring(1)+";");
 return s;
}

function Hints()
{
 var x=window.opener;
 if(!x || !(x=x.document.forms) || !(x=x[0])) return;
 var S='';
 var No=0;
 window.Txt=Array();
 for(i=0; i<x.length; i++)
 {
  var n=x[i];
  var y;
  if('text'!=n.type || !(y=n.value)) continue;
  for(var j=window.Txt.length-1; j>=0; j--)
   if(y==window.Txt[j]) { y=''; break; }
  if(!y) continue;
  S+="&raquo;<A hRef='#' onClick='Click("+No+"); return false;'>"+htmlEsc(y)+"</A>\n";
  window.Txt[No++]=y;
 }
 document.writeln(S);
}
//--></Script>
<Style><!--
Form {
	border: 1px inset;
}
//--></Style>
<H1>Поиск сотрудника</H1>
<Form Action='./' Method='GET' onSubmit='return Validate()'>
<Table><TR vAlign='bottom'><TD>
<?
$CFG->params->q=$CFG->entry->q=trim($_REQUEST['q']);
$as=trim($_REQUEST['as']);
$X=Array(
 ''=>'Начинается на',
 'eq'=>'Равен',
 'end'=>'Кончается на',
 'sub'=>'Содержит',
);
if(!$X[$as])$as='';
$CFG->params->as=$CFG->entry->as=$as;
Select('as', $X, 'Атрибут');
echo "</TD><TD>";
Input('q', 'Текст');
?>
</TD><TD>
<Input Type='Submit' Value='Искать' />
</TD><TD><Small>
<Script><!--
Hints();
//--></Script>
</Small><BR /></TD></TR></Table>
</Form>
<?
if(''==$CFG->entry->q):
?>
<P />
&raquo; Введите начало любого атрибута искомого сотрудника (фамилия, имя, табельный номер...)
<Script><!--
document.forms[0].q.focus();
//--></Script>
<?
else:
 LoadLib('/sort');
 $CFG->sort=Array(
    'n'=>Array('field'=>'Nam', 'name'=>'Имя'),
    't'=>Array('field'=>'TabNo', 'name'=>'Номер', 'title'=>'Табельный номер'),
    'd'=>Array('field'=>'Dept', 'name'=>'Отдел'),
    'p'=>Array('field'=>'Title', 'name'=>'Должность'),
 );
 $CFG->defaults->sort='nt';

 $Schema=$CFG->Abacus->Schema;
 $Filter=AddSlashes(strtr(strtolower($CFG->entry->q), 'ё', 'е'));
 switch($CFG->params->as)
 {
  case "end": $Filter="%$Filter"; break;
  case "sub": $Filter="%$Filter";
  default: $Filter="$Filter%";
  case 'eq':;
 }
 $q=ociParse($CFG->oci, <<<SQL
Select N,
 (Select VALUE From $Schema.OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=7) Nam,
 (Select VALUE From $Schema.OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=8) TabNo,
 (Select VALUE From $Schema.OBJ_ATR_STR A, $Schema.NOM_NOM L
    Where L.ISH_KAT=2004 And L.RES_KAT=2005 AND L.RES_OBJ=N
    And A.N_KAT=2004 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
 ) Dept,
 (Select VALUE From $Schema.OBJ_ATR_STR A, $Schema.NOM_NOM L
    Where L.ISH_KAT=184 And L.RES_KAT=2005 AND L.RES_OBJ=N
    And A.N_KAT=184 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
 ) Title
From (Select Distinct(N_OBJ)N From $Schema.OBJ_ATR_STR Where N_KAT=2005 And VALUE_LOWER Like :Filter)
Where Not Exists(Select * From $Schema.OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=16)
SQL
.sqlOrderBy());
 
 sortedHeader('ntdp');
 ociBindByName($q, "Filter", $Filter);
 ociExecute($q);
 unset($CFG->params->q);
 unset($CFG->params->as);
 unset($CFG->params->sort);
 while(ociFetchInto($q, $r)):
  echo "<TR>";
  $n=$r[0];
  echo "<TD><A hRef='../person/", hRef('n', $r[0]), "'>", htmlspecialchars($r[1]), "</A><BR /></TD>";
  for($i=2; $i<=4; $i++)
   echo "<TD>", htmlspecialchars($r[$i]), "<BR /></TD>";
  echo "</TR>\n";
 endwhile;
 ociFreeStatement($q);

endif;
?>
</Table>
</body></html>
