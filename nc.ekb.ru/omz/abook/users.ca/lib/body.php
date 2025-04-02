<Select Style='position: absolute; top: 0;' onChange='doSave(this);'>
<Option Value=''>Сохранить как...
<Option Value='csv'>CSV
<Option Value='xls'>Excel
<Option Value='json'>JSON
<Option Value='yaml'>YAML
</Select>
<?
LoadLib('filter.body');
LoadLib('/pages');
sortedHeader('sudr');

$h=pfxDB();

$p=PageStart($h->querySingle("Select Count(*)".$CFG->SQL));

pageNavigator();
$s=$h->prepare("Select *".$CFG->SQL." Limit ".$CFG->params->pagesize." Offset ".$p);
$x=$s->execute();
while($r=$x->fetchArray()):
 $A='';
 if($CFG->Auth) $A= inGroupX('#browseDIT')? 'dc/user' : 'abook';
 if($A) $A="<span onMouseMove=\"userThumb(this, ".jsEscape($r[u]).")\"><A hRef='/omz/$A/.?u=".urlencode($r[u])."'>";
 echo '<TR><TD Align="Right" onMouseMove="crtLink(this);">';
 if('stas'==$CFG->u):
  $rnd=substr(md5(rand()), -3);
  echo '<Div Class="crtLink">&raquo;<A hRef="./?n=', $r[id], '">', htmlspecialchars($r[u]), '.cer</A><BR />',
    '&raquo;<A hRef="./', htmlspecialchars(hRef('key', $rnd, 'n', $r[id])), '" title="Pass=', strrev($rnd), '">', htmlspecialchars($r[u]), '.pfx</A><BR />', 
    '&raquo;<A hRef="./', htmlspecialchars(hRef('key', 'old', 'n', $r[id])), '">Old-style PFX</A><BR />',
    '</Div>';
 endif;
 echo '<A hRef="./?n=', $r[id], '">', htmlspecialchars($r[serial]), '</A>';
/*
 if('stas'==$CFG->u) echo "<sup><A hRef='./", htmlspecialchars(hRef('key', 'old', 'n', $r[id])),
    "' style='text-decoration: none; position: relative; left: 0.5ex;' Title='Установка по старой схеме'>!</A></sup>";
*/
 echo '<BR /></TD>',
    '<TD>', $A, htmlspecialchars($r[u]), $A?'</A></span>':'', '<BR /></TD>',
    '<TD><Small>', strtr(htmlspecialchars($r[subj]), Array('/'=>'<wbr>/')), '</Small><BR /></TD>',
//    '<TD>', htmlspecialchars($r[notBefore]), '<BR /></TD>',
//    '<TD>', htmlspecialchars($r[notAfter]), '<BR /></TD>',
    '<TD title="', htmlspecialchars($r[Revoke]), '">', htmlspecialchars(preg_replace('/\s.*/', '', $r[Revoke])), '<BR /></TD>',
    "</TR>\n";
endwhile;
sortedFooter();
pageNavigator();
?>
<Script><!--
function doSave(s)
{
 s.blur();
 if(!s.value.length) return;
 var x=s.value;
 s.value='';
 location=location+(location.search?'&':'?')+'as='+x;
}
//--></Script>
