<LI>Netware-объект:
<B><?=htmlspecialchars($id=strtoupper(trim($_REQUEST['id'])))?></B>
</LI>
<?
$qid="'".strtr($id, Array("'"=>"''"))."'";
global $CFG;
foreach($CFG->nwServers as $s):
 $q=sqlite3_query($CFG->h, "Select * From $s.Objects Where Name=$qid Order By Type");
 while($r=sqlite3_fetch_array($q)):
?>
<BR /><Table Width='100%'>
<TR vAlign='top'><TD RowSpan='2'>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH ColSpan='2'>Параметры</TH></TR>
<TR><TH>Сервер</TH><TD><?=htmlspecialchars($s)?><BR /></TD></TR>
<TR><TH>ID</TH><TD><?=htmlspecialchars($r['Id'])?><BR /></TD></TR>
<TR><TH>Тип</TH><TD><?
switch($r['Type'])
{
 case 1: echo "Пользователь"; break;
 case 2: echo "Группа"; break;
 default: echo htmlspecialchars($r['Type']);
}
?><BR /></TD></TR>
<?
$NN=Array("GROUPS_I'M_IN"=>1, "SECURITY_EQUALS"=>1, "GROUP_MEMBERS"=>1, "OBJ_SUPERVISORS"=>1);
$qq=sqlite3_query($CFG->h, "Select Name, Value From $s.Vals, $s.Props Where Vals.objN=".$r['N'].
    " And Vals.propN=Props.N Order By Name");
while($rr=sqlite3_fetch_array($qq)):
 echo "<TR><TH>", htmlspecialchars($rr['Name']), "<BR /></TH><TD>";
 $v=$rr['Value'];
 if('IDENTIFICATION'==$rr['Name']) $v=iconv("CP866", "CP1251", $v);
 if($NN[$rr['Name']]):
  $v=join("\n", array_map("nLink", preg_split('/[\n\r]+/', $v)));
 else:
  $v=nl2br(htmlspecialchars($v));
 endif;

 if("LOGIN_CONTROL"==$rr['Name']) $v="<Small>$v</Small>";
 echo $v, "<BR /></TD></TR>\n";
endwhile;
sqlite3_query_close($qq);
?>
</Table>
</TD><TD>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH ColSpan='3'>Права</TH></TR>
<?
$qq=sqlite3_query($CFG->h, "Select * From $s.Trustee Where objN=".$r['N']." Order By Path");
while($rr=sqlite3_fetch_array($qq)):
 echo "<TR><TD>", htmlspecialchars($rr['Path']), "<BR /></TD><TD>",
    htmlspecialchars($rr['Hex']), "<BR /></TD><TD><Small>",
    htmlspecialchars(preg_replace('|\s+|', '', $rr['Txt'])), "</Small><BR /></TD></TR>\n";
endwhile;
sqlite3_query_close($qq);
?>
</Table>
</TD></TR><TR><TD vAlign='bottom'>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'><TH>Скрипт</TH></TR>
<TR><TD NoWrap>
<?
$qq=sqlite3_query($CFG->h, "Select Script From $s.Script where objN=".$r['N']);
$r=sqlite3_fetch($qq);
sqlite3_query_close($qq);
echo nl2br(htmlspecialchars($r[0]));
?>
<BR /></TD></Table>
</TD></TR></Table>
<?
 endwhile;
 sqlite3_query_close($q);
endforeach;

function nLink($S)
{
 return "<A hRef='./".htmlspecialchars(hRef('id', $S))."'>".htmlspecialchars($S)."</A>";
}

?>
