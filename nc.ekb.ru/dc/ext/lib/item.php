<Style><!--
.Photo {
    margin: 0.5ex;
    border: 2px ridge;
    padding: 0.3ex;
    background: #A0C0F0;
}

.Photo Img {
    border: 2px ridge;
}
.Panel {
    border: 2px groove;
    padding: 0.5ex;
}
//--></Style>
<xScript Src='item.js'></xScript>
<Form onSubmit='false'>
<Table Width='100%'><TR vAlign='top'><TD>
<Table Border CellSpacing='0' Width='100%'><TR Class='tHeader'>
<TH>Атрибут</TH><TH>Значение</TH></TR>
<Script><!--
window.Attrs=new Array();
<?
global $CFG;

setlocale(LC_ALL, "ru_RU.cp1251");

$CFG->Attrs=Array();

LoadLib($CFG->params->x.'.connect');
LoadLib($CFG->params->x.'.item');

foreach($CFG->Attrs as $a):
 if('imgURL'==$a['Field']) $imgURL=$a['URL'];
 if(!$imgURL and 'employeeID'==$a['Field'] and file_exists($_SERVER['DOCUMENT_ROOT'].($f="/img/photo/{$a['Value']}.jpg"))) $imgURL=$f;

 if(!strlen($a['Name'])) continue;
 $v=rtrim($a['Value']);
 echo "A=new Object();\nA.Name=", jsEscape($a['Name']), 
    ";\nA.v=", jsEscape($v), ";\n";
 if($a['Field']):
  echo "A.Field=", jsEscape($a['Field']), ";\n";
  if($a['X-Value']):
   echo "A.x=", jsEscape($a['X-Value']), ";\n";
  else:
   echo "A.u=", jsEscape(strtoupper($v));
   $v=strtolower($v);
   echo ";\nA.l=", jsEscape($v),
    ";\nA.f=", jsEscape(ucfirst($v)),
    ";\nA.p=", jsEscape(preg_replace_callback('/(?<![[:alpha:]])[[:alpha:]]/', upChar, $v)),
    ";\n";
  endif;
 endif;
 echo "window.Attrs[window.Attrs.length]=A;\n";
endforeach;


function upChar($m)
{
 return strtoupper($m[0]);
}

?>
tBody();
//--></Script>
</Table>
</TD><TD NoWrap>
<Div Class='Panel'>
<Input Type='CheckBox' Name='All' id='i*' onClick='checkAll(this)' Disabled /><Label For='i*'>Все атрибуты</Label><BR />
<?
$Cases=Array(
    'v'=>'Как есть',
    'u'=>'БОЛЬШИМИ БУКВАМИ',
    'l'=>'малыми буквами',
    'f'=>'Первая буква большая',
    'p'=>'С Больших Букв',
);
$CFG->entry->case='f';
Select('case', $Cases, 'Регистр');
?><P />
<Input Type='Button' Value=' Копировать! ' onClick='copyAll()' />
</Div>
<?
if($imgURL)
 echo "<BR /><Center><Span Class='Photo'><Img Src='$imgURL' Alt='Фото' /></Span>";
?>
</TD></TR></Table>
</Form>
<Script><!--
enableAll();
//--></Script>
