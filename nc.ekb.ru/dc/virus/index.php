<?
require("../../lib/uxm.php");
if(!preg_match('/^(\\d+\\.){4}$/', ($CFG->params->ip=trim($_REQUEST['ip'])).".")) $CFG->params->ip='';

$backLinks=1;

uxmHeader('�������� ������');
?>
<H1>�������� ������
<Table Border CellSpacing='0'>
<TR><TH Align='Right'>IP-�����</TH><TD><?=$CFG->params->ip?></TD></TR>
<TR><TH Align='Right'>��� ����������</TH><TD><?= 
 htmlspecialchars(preg_replace('/\\.uxm$/', '', 
    sqlGet("Select host From ip2host Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')")))
?><BR /></TD></TR>
<TR><TH Align='Right'>�����</TH><TD><?=htmlspecialchars(trim($_REQUEST['vir']))?>
</TD></TR>
</Table>
</H1>
<?
LoadLib('/ditobj');
LoadLib('/sort');
//$CFG->sort['u']=Array('field'=>'u', 'name'=>'������������', 'title'=>'������� ������, ��� ������� ������������� ������');
$CFG->sort['b']=Array('field'=>'b', 'name'=>'��', 'rev'=>1, 'title'=>'�������� ������, ��������');
$CFG->sort['m']=Array('field'=>'mail', 'name'=>'�����', 'title'=>'�������������� �� ������ �����');
$CFG->sort['o']['name']='�����';
$CFG->sort['n']['name']='������������';
$CFG->defaults->oClasses='u';
$CFG->defaults->sort='b';

$q=mysql_query("Select * From ipUse Where ip='{$CFG->params->ip}' And Month=Date_Format(Now(), '%Y%m')");
while($r=mysql_fetch_object($q)):
 $x=getObject(user2dn($r->u));
 if(!$x) continue;
 $x->b=$r->b;
 $x->mail=$r->mail;
 $Items[]=$x;
endwhile;
sortArray($Items);
sortedHeader('noibm');
if(is_array($Items))
foreach($Items as $x):
 echo "<TR><TD>", htmlspecialchars($x->name), "</TD><TD>", htmlspecialchars($x->ou), "</TD><TD>";
 if($backLinks) echo '<A hRef="../user/', hRef('u', $x->id), '">';
 echo htmlspecialchars($x->id);
 if($backLinks) echo "</A>";
 echo "</TD><TD Align='Right'>";
 if($x->b) printf("%.1f", $x->b/1024/1024);
 echo "<BR /></TD><TD Align='Center'>", $x->mail?'+':'-';
 echo "</TD></TR>\n";
endforeach;
sortedFooter();

?>

</body></html>
