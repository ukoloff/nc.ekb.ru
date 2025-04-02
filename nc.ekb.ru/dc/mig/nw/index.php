<?
require('../../../lib/uxm.php');
//LoadLib('/pages');
LoadLib('/sort');

$CFG->sort=Array(
    '-'=>Array('name'=>'#'),
    'u'=>Array('field'=>'u', 'name'=>'Юзер'),
//    's'=>Array('field'=>'server', 'name'=>'Сервер'),
    'm'=>Array('field'=>'MAC', 'name'=>'MAC'),
    'i'=>Array('field'=>'ip', 'name'=>'IP'),
    'h'=>Array('field'=>'Host', 'name'=>'Хост'),
    'x'=>Array('field'=>'dUser', 'name'=>'D', 'title'=>'Пользователь в домене'),
    'y'=>Array('field'=>'migN', 'name'=>'M', 'title'=>'Хост мигрирован'),
    'z'=>Array('field'=>'Lan', 'name'=>'L', 'title'=>'Хост.lan.uxm'),
    'q'=>Array('field'=>'netLogon', 'name'=>'N', 'title'=>'NetLogon настроен'),
    'c'=>Array('field'=>'Comment', 'name'=>'Заметки'),
);
$CFG->defaults->sort='u';

uxmHeader('Netware');
?>
<H1>Миграция Netware</H1>
<?
if(!function_exists('sqlite3_open')) dl('sqlite3.so');
$CFG->db=sqlite3_open('data/netlogon.db');

$NL=array();
$q=sqlite3_query($CFG->db, "Select * From NetLogon");
while($r=sqlite3_fetch_array($q)):
  $NL[strtolower($r['u'])]=$r['Time'];
endwhile;
sqlite3_query_close($q);

$Comm=array();
$q=sqlite3_query($CFG->db, "Select * From ipComment");
while($r=sqlite3_fetch_array($q)):
  $Comm[$r['ip']]=$r['Note'];
endwhile;
sqlite3_query_close($q);

$q=mysql_query(<<<SQL
Select Distinct u, nwusers.MAC, ip, Host
From nwusers Left Join ip2mac Using(Month, MAC)
Where nwusers.Month=Date_Format(Now(), '%Y%m')
SQL
);

$X=array();
while($r=mysql_fetch_object($q)):
  $r->dUser=user2dn(strtolower($r->u))?1:0;
  if($r->ip):
   $qq=mysql_query("Select N From migHost Where ip='{$r->ip}' Order By At Desc Limit 1");
   if($rr=mysql_fetch_array($qq)) $r->migN=$rr[0];
   $qq=mysql_query("Select host From ip2host Where ip='{$r->ip}' Order By Month Desc Limit 1");
   if(($rr=mysql_fetch_array($qq)) and substr($rr[0], -8)=='.lan.uxm')$r->Lan=1;
   $r->Comment=$Comm[$r->ip];
  endif;
  if($NL[strtolower($r->u)])$r->netLogon=1;
  $X[]=$r;
  unset($r);
endwhile;

sortArray($X);

$N=0;
SortedHeader('-umihxyzqc');
foreach($X as $r):
 echo "<TR><TD Align='Right'><Small>", ++$N, "</Small></TD><TD>";
 if($r->dUser) echo "<A hRef='/dc/user/", htmlspecialchars(hRef('u', strtolower($r->u))), "' Target='_blank'>";
 echo htmlspecialchars(strtolower($r->u));
 if($r->dUser) echo "</A>";
 echo "<BR /></TD><TD>",
//    htmlspecialchars($r->server), "<BR /></TD><TD><TT>",
    htmlspecialchars($r->MAC), "</TT><BR /></TD><TD>",
    htmlspecialchars($r->ip), "<BR /></TD><TD>",
    htmlspecialchars($r->Host), "<BR /></TD><TD Align='Center'>",
    $r->dUser?'+':'', "<BR /></TD><TD Align='Center'>";
 if($r->migN) echo "<A hRef='../host/", htmlspecialchars(hRef('n', $r->migN)),"' Target='_blank'>+</A>";
 echo "<BR /></TD><TD Align='Center'>",
    $r->Lan? '+':'', "<BR /></TD><TD Align='Center'>";
 if(!$r->netLogon and $r->dUser)
   echo "<A hRef='click/", htmlspecialchars(hRef('u', strtolower($r->u))), "' Target='_blank'>";
 echo $r->netLogon? '+':'-';
 if(!$r->netLogon and $r->dUser)
  echo "</A>";
 echo "<BR /></TD><TD><Small><A hRef='note/", htmlspecialchars(hRef('ip', $r->ip)),
    "' Target='_blank' Title='Правка'>&raquo;</A>\n", htmlspecialchars($r->Comment), "</Small></TD></TR>\n";
endforeach;

SortedFooter();
?>


</body></html>

