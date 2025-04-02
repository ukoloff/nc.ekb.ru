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

uxmHeader('Отметка о миграции скрипта');
?>
<Script><!--
function AreYouSure()
{
 return !confirm('А может всё таки не будем ставить отметку? ;-)');
}
//--></Script>
<H1>Отметка о миграции скрипта</H1>
&raquo;
Миграция (из Netware):
<?
if(!$CFG->params->u):
?>
<Div Class='Error'>Нет такого пользователя (<?=htmlspecialchars($_REQUEST['u'])?>) в домене!</Div>
<? else: 
$q=sqlite3_query($CFG->db, "Select * From NetLogon Where u='{$CFG->params->u}'");
$r=sqlite3_fetch_array($q);
sqlite3_query_close($q);
if(!$r):
 echo "Не проведена";
else:
 setlocale(LC_ALL, "ru_RU.cp1251");
 echo strftime("%x %X", $r['Time']), ", <A hRef='/dc/user/", hRef('u', $r['Admin']), "' Target='_blank'>", $r['Admin'], "</A>";
endif;
echo "<BR />\n";

LoadLib('/user');
UserInfo($CFG->params->u, 1);
?>
&raquo;
Посмотреть на <A hRef='/dc/user/<?=htmlspecialchars(hRef('x', 'netlogon'))?>'>скрипт подключения</A>
<?
if(!$r and inGroupX('Domain Admins')):
echo "<BR />&raquo\nОтметить, что <A onClick='return AreYouSure()' hRef='./",
    htmlspecialchars(hRef('x', 'mark')), "'>миграция из Новела проведена</A>\n";
endif;
endif;
?>
</body></html>
