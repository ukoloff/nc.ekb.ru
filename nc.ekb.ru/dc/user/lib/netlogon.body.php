<Script><!--
function stdScript()
{
 var s=document.forms[0].scriptPath;
 s.value=<?= jsEscape("user\\".$CFG->params->u{0}."\\".$CFG->params->u.".bat")?>;
 s.focus();
}
//--></Script>
<?
global $CFG;
LoadLib('/forms');
?>
<Form Action='./' Method='Post'>
<Table><TR vAlign='bottom'><TD>
<?
Input('scriptPath', 'Скрипт подключения');
echo "</TD><TD>\n";
Submit();
HiddenInputs();
?>
</TD></TR></Table>
&raquo;
<A hRef="#" onClick="stdScript(); return false;">Задать скрипт по умолчанию</A>
</Form>
<Div Class='winPath'>\\<?= htmlspecialchars($CFG->Samba->Server)
?>\<A hRef='./<?= htmlspecialchars(hRef('path', "\\"))
?>'><?= htmlspecialchars($CFG->Samba->Folder) ?></A><?
$path=trim($_REQUEST['path']);
if(!$path)$path=$CFG->entry->scriptPath;
if(!$path)$path='user';
$path=$CFG->Samba->winPath($path);
$cpath='';
foreach(explode("\\", $path) as $p):
 $cpath.="\\".$p;
 echo "\\<A\nhRef='", htmlspecialchars(hRef('path', $CFG->Samba->winPath($cpath))), "'>", htmlspecialchars($p), "</A>";
endforeach;
echo "</Div>\n";
$CFG->params->path=$path;
$CFG->Bottom->Root=1;
if($path) $CFG->Bottom=$CFG->Samba->fileAttrs($path);
LoadLib($CFG->params->x.".".($CFG->Bottom? ($CFG->Bottom->isFile? 'file' : 'folder') : 'none'));
?>
