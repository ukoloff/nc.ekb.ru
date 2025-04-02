<Style><!--
img#photo	{
    border: 2px groove;
    position: absolute;
    right: 1em;
    cursor: move;
}
--></Style>
<Script><!--
function Validate(X)
{
 var z=X.z;
 if(!z) return false;
 for(var i=z.length-1; i>=0; i--)
  if(z[i].checked)
   switch(z[i].value)
   {
//    case '-':
//    case 'v': return true;
    case '/': 
	if(X.jpg.value.match(/\.jp(e?)g$/)) return true; 
	alert('Выберите файл в формате JPEG!'); X.jpg.value='';
	return false;
    default: 
	return true;
   }
 return false;
}
//--></Script>
<Form Action='./' Method='POST' enctype="multipart/form-data" onSubmit='return Validate(this)'>
<?
LoadLib('/forms');
LoadLib('/userPhoto');

HiddenInputs();

if(!$CFG->udn) return;
$e=getEntry($CFG->udn, 'employeeID');

if(hasPhoto($CFG->udn)):
?>
<img Align="Right" src='/omz/abook/?jpg&u=<?=htmlspecialchars(urlencode($CFG->params->u))?>' id='photo' onMouseDown='startDrag(this, event)' />
<? endif; ?>
<LI><b>Табельный №</b>: <?=utf2html($tabNo=$e[$e[0]][0])?>
<?
$q=@ldap_read($CFG->AD->h, $CFG->udn, 'objectClass=*', Array('jpegPhoto', 'thumbnailPhoto'));
$q=@ldap_first_entry($CFG->AD->h, $q);
$e=@ldap_get_values_len($CFG->AD->h, $q, 'jpegPhoto');
echo "<LI><b>Jpeg</b>:\n";
for($i=0; $i<$e['count']; $i++)
  echo strlen($e[$i]), "b\n";
$e=@ldap_get_values_len($CFG->AD->h, $q, 'thumbnailPhoto');
echo "<LI><b>Thumbnail</b>:\n";
for($i=0; $i<$e['count']; $i++)
  echo strlen($e[$i]), "b\n";
?>
<Table><TR><TD>
<FieldSet><Legend>
Операция
</Legend>
<?
RadioButton('z', '-', 'Очистить'); HR();
RadioButton('z', '/', 'Загрузить из файла');
?>
<br>
<Input Type='File' style='margin-left: 2em;' name='jpg' onClick='this.form.z[1].checked=true' /><BR />
<? 
$CFG->entry->j10k = 1;
CheckBox('j10k', 'Сжать до 10 кб, если больше');
?>
<hr>
<?
RadioButton('z', 'v2011', 'Взять из старой БД ВОХР (Lenel)'); 
?>
<li style='margin-left: 2em;'><small>
<a href="../db/<?=hRef('x', 'v2011', 'as', 'n', 'q', $tabNo, 'u')?>" target='voxrPhoto' title='По табельному №'>Поиск в старой БД ВОХР</a>
</small></li>
<hr>
<?
RadioButton('z', 'sigur', 'Взять из БД СКУД Sigur'); 
?>
<li style='margin-left: 2em;'><small>
<a href="../db/<?=hRef('x', 'sigur', 'as', 'n', 'q', $tabNo, 'u')?>" target='voxrPhoto' title='По табельному №'>Поиск в БД ВОХР Sigur</a>
</small></li>
</FieldSet>
</TD><TD vAlign='bottom'>
<? Submit(); ?>
</TD></TR></Table>
</Form>
