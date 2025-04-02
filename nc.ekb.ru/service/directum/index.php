<?
//ini_set("display_errors", 1);

require("../../lib/uxm.php");
AuthorizedOnly();
LoadLib('/sort');
$CFG->sort=Array(
    '.'=>Array('field'=>'', 'name'=>'№', ),
    'h'=>Array('field'=>'hostname', 'name'=>'Хост', 'title'=>'Имя машины'),
    'l'=>Array('field'=>'login', 'name'=>'Пользователь'),
    'd'=>Array('field'=>'DB', 'name'=>'БД'),
    'n'=>Array('field'=>'N', 'name'=>'Соединений', 'title'=>'Сколько соединений с БД установлено'),
);
$CFG->defaults->sort='l';

uxmHeader('Работа в Directum');
?>
<H1>Работа в Directum</H1>
<?
if(!function_exists('mssql_pconnect')) dl('mssql.so');
$CFG->Directum->h=@mssql_pconnect('directum', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
echo "<!--", $CFG->Directum->h, '-->';
$q=mssql_query(<<<SQL
Select 
 hostname, loginame, 
 (Select name From master..sysdatabases Where dbid=SP.dbid) As DB, count(*) As N
From master..sysprocesses AS SP
Where program_name='IS-Builder'
And loginame<>'ISBuilderSystem'
Group by hostname, loginame, dbid
SQL
, $CFG->Directum->h);
$X=Array();
while($r=mssql_fetch_object($q)):
 if(!preg_match('/^((.+)\\\\)?(.+)/', trim($r->loginame), $match)) continue;
 $r->Domain=$match[2];
 $r->login=$match[3];
 $X[]=$r;
endwhile;
sortArray($X);
sortedHeader('.hldn');
$NN=0;
foreach($X as $r):
 $A='';
 if('LAN'==$r->Domain)
    $A="lan\\<A hRef='/dc/user/".htmlspecialchars(hRef('u', $r->login, 'sort'))."'>";
 if('OMZGLOBAL'==$r->Domain)
    $A="omz\\<A hRef='/omz/dc/user/".htmlspecialchars(hRef('u', $r->login, 'sort'))."'>";
 echo "<TR><TD Align='Right'>", ++$NN, "</TD><TD>", htmlspecialchars($r->hostname), "<BR /></TD><TD>",
    $A, htmlspecialchars($r->login), $A? "</A>":"", "<BR /></TD><TD>",
    htmlspecialchars($r->DB), "<BR /></TD><TD Align='Right'>", $r->N, "<BR /></TD></TR>\n";
endforeach;
sortedFooter();
//echo "<PRE>"; print_r($X);
if($CFG->intraNet): ?>
&raquo;
<A hRef='file://Directum/Client/Script/kill.hta'>Скачать программу просмотра/отключения пользователей</A>
<?endif;?>

</body></html>
