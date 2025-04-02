<?
LoadLib('/sort');
$CFG->sort=Array(
    '.'=>Array('field'=>'', 'name'=>'№', ),
    'h'=>Array('field'=>'hostname', 'name'=>'Хост', 'title'=>'Имя машины'),
    'l'=>Array('field'=>'login', 'name'=>'Пользователь'),
    'd'=>Array('field'=>'DB', 'name'=>'БД'),
    'm'=>Array('field'=>'mins', 'name'=>'Минут'),
    'n'=>Array('field'=>'N', 'name'=>'Соединений', 'title'=>'Сколько соединений с БД установлено'),
);
$CFG->defaults->sort='l';

function m2h($mins)
{
  if($mins<60)
    return $mins;
  $h = (int)($mins/60);
  if($h<24)
    return sprintf("%d:%02d", $h, $mins % 60);
  return sprintf("%d:%02d:%02d", (int)($h/24), $h%24, $mins%60);
}

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$CFG->Directum->h=@mssql_pconnect('directum', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);

$q=mssql_query(<<<SQL
Select 
 hostname, nt_username,
 datediff(minute, min(login_time), sysdatetime()) as mins,
 (Select name From master..sysdatabases Where dbid=SP.dbid) As DB, count(*) As N
From master..sysprocesses AS SP
Where program_name='IS-Builder'
And loginame<>'ISBuilderSystem'
Group by hostname, nt_username, dbid
SQL
, $CFG->Directum->h);
$X=Array();
while($r=mssql_fetch_object($q)):
// if(!preg_match('/^((.+)\\\\)?(.+)/', trim($r->loginame), $match)) continue;
// $r->Domain=$match[2];
// $r->login=$match[3];
 $r->login = trim($r->nt_username);
 $X[]=$r;
endwhile;
sortArray($X);
sortedHeader('.hldmn');
$NN=0;
foreach($X as $r):
 $A='';
// if('LAN'==$r->Domain)
//    $A="lan\\<A hRef='/dc/user/".htmlspecialchars(hRef('u', $r->login, 'sort'))."'>";
// if($CFG->AD->Domain==$r->Domain)
 $A="<A hRef='/omz/dc/user/".htmlspecialchars(hRef('u', $r->login, 'sort'))."'>";
 echo "<TR><TD Align='Right'>", ++$NN, "</TD><TD>", htmlspecialchars($r->hostname), "<BR /></TD><TD>",
    $A, htmlspecialchars($r->login), $A? "</A>":"", "<BR /></TD><TD>",
    htmlspecialchars($r->DB), "<BR /></TD><TD Align='Right'>",
    m2h($r->mins), "<BR></TD><TD Align='Right'>", $r->N, "<BR /></TD></TR>\n";
endforeach;
sortedFooter();

if(!$CFG->intraNet) return;
?>
<!--
&raquo;
<A hRef='file://Directum/Client/Script/kill.hta'>Скачать программу просмотра/отключения пользователей</A>
-->