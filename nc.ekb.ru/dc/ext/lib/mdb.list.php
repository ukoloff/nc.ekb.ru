<?
global $CFG;

//echo "=", $CFG->odbt, "=";

switch($CFG->entry->as)
{
 case 'i': $COL='���'; break;
 case 'o': $COL='��������'; break;
// case 'n': $COL='tab_num'; break;
 default: $COL='�������';
}
$q=odbtp_query("Select * From Users Left Join Groups On Users.GroupPtr=Groups.GroupPtr Where $COL Like '".
    strtr($CFG->entry->q, array("'"=>"''"))."%' Order by �������", $CFG->odbt);
?>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>�.�.�.</TH>
<TH>�����</TH>
<TH>������</TH>
</TR>
<?
unset($CFG->params->q);
while($r=odbtp_fetch_assoc($q)):
 echo "<TR><TD><A hRef='./", hRef('i', $r['UserPtr']), "'>",
    htmlspecialchars($r['�������'].' '.$r['���'].' '.$r['��������']), '</A><BR /></TD><TD>',
    htmlspecialchars($r['Name']), '<BR /></TD><TD><Font Size="0">',
    nl2br(htmlspecialchars(trim($r['Details1']))), "</Font>",
    "<BR /></TD></TR>\n";
//  print_r($r);
endwhile;
?>
</Table>
