<?
global $CFG;

switch($CFG->entry->as)
{
 case 'i': $COL='im'; break;
 case 'o': $COL='ot'; break;
// case 'n': $COL='tab_num'; break;
 default: $COL='fam';
}
$q=odbtp_query("Select * From worker Left Join dept On worker.cod=dept.cod Where UPPER($COL) Like UPPER('".
    strtr($CFG->entry->q, array("'"=>"''"))."%') Order by fam", $CFG->odbt);
?>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>Таб. №</TH>
<TH>Ф.И.О.</TH>
<TH>Отдел</TH>
<TH>Данные</TH>
</TR>
<?
unset($CFG->params->q);
while($r=odbtp_fetch_assoc($q)):
 echo "<TR><TD><A hRef='./", htmlspecialchars(hRef('i', $r['tab_num'])), "'>", htmlspecialchars($r['tab_num']),
    "<BR /></A></TD><TD>",
    htmlspecialchars($r['fam'].' '.$r['im'].' '.$r['ot']), '<BR /></TD><TD>',
    htmlspecialchars($r['dept']), '<BR /></TD><TD><Font Size="0">',
    nl2br(htmlspecialchars(trim($r['dop_sv']))), "</Font>",
    "<BR /></TD></TR>\n";
//  print_r($r);
endwhile;
?>
</Table>
