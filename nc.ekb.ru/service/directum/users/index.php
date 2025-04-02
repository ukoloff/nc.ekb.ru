<?
//ini_set("display_errors", 1);

require("../../../lib/uxm.php");

uxmHeader('Пользователи Directum');
?>
<H1>Пользователи Directum</H1>
<x-OL>
<?
if(!function_exists('mssql_pconnect')) dl('mssql.so');
$z=@mssql_pconnect('directum', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);
mssql_select_db('Directum');

$q=mssql_query(<<<SQL
Select UserKod, UserName
From dbo.MBUser As X, sysusers As Y
Where UserType='П' And NeedEncode='W'
And X.UserKod=Y.name
Order By 1
SQL
, $z);
while($r=mssql_fetch_row($q)):
  echo "<LI>", $r[0], "\t", $r[1];
endwhile;
?>

</body></html>
