<?
require('../../../../lib/uxm.php');

if(user2dn($_REQUEST['u'])):
 $CFG->params->u=strtolower($_REQUEST['u']);
endif;

if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$CFG->db=sqlite3_open('../data/netlogon.db');

if('mark'==$_REQUEST['x'] and $CFG->params->u and inGroupX('Domain Admins')):
 sqlite3_exec($CFG->db, "Insert Or Ignore Into NetLogon(u, Time, Admin)
    Values('{$CFG->params->u}', strftime('%s', 'now'), '{$CFG->u}')")
    or die("Error ".sqlite3_error($CFG->db));
 Header('Location: ./'.hRef());
endif;

uxmHeader('������� � �������� �������');
?>
<Script><!--
function AreYouSure()
{
 return !confirm('� ����� �� ���� �� ����� ������� �������? ;-)');
}
//--></Script>
<H1>������� � �������� �������</H1>
&raquo;
�������� (�� Netware):
<?
if(!$CFG->params->u):
?>
<Div Class='Error'>��� ������ ������������ (<?=htmlspecialchars($_REQUEST['u'])?>) � ������!</Div>
<? else: 
$q=sqlite3_query($CFG->db, "Select * From NetLogon Where u='{$CFG->params->u}'");
$r=sqlite3_fetch_array($q);
sqlite3_query_close($q);
if(!$r):
 echo "�� ���������";
else:
 setlocale(LC_ALL, "ru_RU.cp1251");
 echo strftime("%x %X", $r['Time']), ", <A hRef='/dc/user/", hRef('u', $r['Admin']), "' Target='_blank'>", $r['Admin'], "</A>";
endif;
echo "<BR />\n";

LoadLib('/user');
UserInfo($CFG->params->u, 1);
?>
&raquo;
���������� �� <A hRef='/dc/user/<?=htmlspecialchars(hRef('x', 'netlogon'))?>'>������ �����������</A>
<?
if(!$r and inGroupX('Domain Admins')):
echo "<BR />&raquo\n��������, ��� <A onClick='return AreYouSure()' hRef='./",
    htmlspecialchars(hRef('x', 'mark')), "'>�������� �� ������ ���������</A>\n";
endif;
endif;
?>
</body></html>
