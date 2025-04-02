<Script Src='item.js?<?=strftime('%d')?>'></Script>
<?
LoadLib('/forms');

setlocale(LC_ALL, "ru_RU.cp1251");
$CFG->Attrs=Array();

dbConnect();
LoadLib($CFG->params->x.'.item');

?>
<Form onSubmit='false'>
<Table Border CellSpacing='0' Width='100%'><TR Class='tHeader'>
<TH>Атрибут</TH><TH Width='100%'>Значение</TH></TR>
<TR><TD Align='Right'><Label For='**'><i>Все атрибуты</i></Label>
<Input Type='CheckBox' Name='**' id='**' onClick='checkAll(this)' Disabled />
</TD><TD>
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

function upChar($m)
{
 return strtoupper($m[0]);
}
?>
<Input Type='Button' Value=' Копировать! ' onClick='copyAll()' />
</TD></TR>
<Script><!--
var Attrs=[
<?
$N=0;
foreach($CFG->Attrs as $a):
 if($a['Photo']):
  $CFG->Photo=$a['Photo'];
  $CFG->Thumb=$a['Thumb'];
 endif;
 if('employeeID'==$a['Field']) $CFG->employeeID=$a['Value'];
 if(!strlen($a['Name'])) continue;
 if($N++) echo ",\n";
 $v=rtrim($a['Value']);
 echo "{n: ", jsEscape($a['Name']),
    ",\n\tv: ", jsEscape($v);
 if(strlen($a['Field'])):
  echo ",\n\tu: ", jsEscape(strtoupper($v));
  $v=strtolower($v);
  echo ",\n\tl: ", jsEscape($v),
    ",\n\tf: ", jsEscape(ucfirst($v)),
    ",\n\tp: ", jsEscape(preg_replace_callback('/(?<![[:alpha:]])[[:alpha:]]/', upChar, $v)),
    ",\n\tt: ", jsEscape($a['Field']);
 endif;
 if(strlen($a['URL']))
  echo ",\n\tw: ", jsEscape($a['URL']);
 echo "}";
endforeach;

if($CFG->employeeID and !$CFG->Photo and file_exists($_SERVER['DOCUMENT_ROOT'].($f="/img/photo/{$CFG->employeeID}.jpg"))):
  $CFG->Photo='file/'.$CFG->employeeID;
  $CFG->Thumb=$f;
endif;

if($CFG->Photo):
 if($N) echo ",\n";
?>
{n: 'Фото',
    jpg: <?=jsEscape($CFG->Thumb)?>,
    v: <?=jsEscape($CFG->Photo)?>,
    t: 'imgURL'}
<?
endif;
?>
];

tBody();
setInterval(enableAll, 0);
//--></Script>
</Table>
</Form>
