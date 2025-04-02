<Style><!--
A.Q	{
    background: silver;
    border: solid 1px black;
    font-family: monospace;
    text-decoration: none;
    font-size: 70%;
    padding: 0 0.9ex;
}
Div.Q	{
    padding-left: 2em;
}
--></Style>
<Script><!--
function Q(A)
{
 A.blur();
 var z=findId('/'+A.id.substring(1));
 if(!z) return;
 if('+'==A.innerHTML)
 {
  A.innerHTML='-';
  z.style.display='block';
 }
 else
 {
  A.innerHTML='+';
  z.style.display='none';
 }
}
//--></Script>
<Form Action='./'>
<Div Align='Right'>
<?
LoadLib('/forms');
$CFG->entry->db=(int)trim($_REQUEST['db']);
$CFG->params->login=' ';
foreach(Array('ЗУП;;;_Reference74', 'УПП;Q1;UPP;_Reference143') as $k=>$v):
 list($Name, $Srv, $DB, $Table)=explode(';', $v);
 if($k==$CFG->entry->db or !isset($sqlTable)):
  $sqlTable=$Table;
  $CFG->c1->Srv=$Srv;
  $CFG->c1->DB=$DB;
 endif;
 $Y[]=$Name;
endforeach;
$CFG->defaults->Input->BR="\n";
$CFG->defaults->Input->extraAttr="onChange='this.form.submit()'";
Select('db', $Y, 'База данных');
hiddenInputs();
echo "</Div></Form>";
dbConnect();
$q=mssql_query("Select * From $sqlTable Order By _Code");
global $L;
while($r=mssql_fetch_object($q))
  foreach($r as $k=>$v):
    unset($z);
    $z->Name=trim($r->_Code);
    $z->Desc=trim($r->_Description);
    $z->Parent=bin2hex($r->_ParentIDRRef);
    $L[bin2hex($r->_IDRRef)]=$z;
  endforeach;
foreach($L as $k=>$v)
  if(isset($L[$v->Parent]))$L[$v->Parent]->N++;
echoChildren();

function echoChildren($Parent=null)
{
 global $L;
 foreach(array_keys($L) as $k):
  $v=$L[$k];
  if($Parent and $v->Parent!=$Parent) continue;
  if(!$Parent and !($k==$v->Parent or !isset($L[$v->Parent]))) continue;
  echo "<Div><A Class='Q' hRef='#' id='*", htmlspecialchars($k), "' onClick='Q(this); return false;'>", 
    $v->N? '-':'&nbsp;', "</A> ", htmlspecialchars($v->Name), 
    ' (<i>', htmlspecialchars($v->Desc),  "</i>)</Div>";
  if(!$v->N) continue;
  echo "<Div Class='Q' id='/", htmlspecialchars($k), "'>";
  echoChildren($k);
  echo "</Div>";
 endforeach;
}
?>
