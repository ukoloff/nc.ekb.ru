<?
global $CFG;

//ini_set("display_errors", 1);

setlocale(LC_ALL, "ru_RU.cp1251");

//$CFG->Directum->DBs=Array('Directum', 'Sandbox');
$CFG->Directum->DBs=Array('Directum');

if(!function_exists('mssql_pconnect')) dl('mssql.so');
if($CFG->Directum->h=@mssql_pconnect('directum', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']))
  getFlags();

function getFlags()
{
 global $CFG;

 $x=mssql_query("Select Count(*) As N From master..sysxlogins Where name=".mssql_escape("LAN\\".$CFG->params->u),
    $CFG->Directum->h);
 $y=mssql_fetch_row($x);
 $y=$CFG->Directum->Entry->Login=1==$y[0];
 $N=0;
 foreach($CFG->Directum->DBs As $DB):
  mssql_select_db($DB, $CFG->Directum->h);
//  echo $CFG->params->u, "#";
//  echo "Select Count(*) As N From sysusers Where name=".mssql_escape($CFG->params->u);
  $x=mssql_query("Select Count(*) As N From sysusers Where name=".mssql_escape($CFG->params->u), $CFG->Directum->h);
  $y=mssql_fetch_row($x);
  $x='Role'.$N;
  $CFG->Directum->Entry->$x=1==$y[0];
  $x=mssql_query("Select Count(*) As N From MBUser Where UserKod=".mssql_escape($CFG->params->u), $CFG->Directum->h);
  $y=mssql_fetch_row($x);
  if(1==$y[0]):
   $x=mssql_query("Select UserName as Name, NeedEncode As Mode, UserStatus As X From MBUser Where UserKod=".
    mssql_escape($CFG->params->u), $CFG->Directum->h);
   $y='User'.$N;
   $CFG->Directum->Entry->$y=mssql_fetch_object($x);
  endif;
  $N++;
 endforeach;
}

function mssql_escape($S)
{
 return isset($S)? "'".strtr($S, "'", "''")."'" : "NULL";
}

?>
