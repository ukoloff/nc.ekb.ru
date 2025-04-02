<?
LoadLib('directum.connect');

$CFG->Directum->DBs=Array('Directum', 'Cat', 'Etalon');

if($CFG->Directum->h)
  getFlags();

function getFlags()
{
 global $CFG;

 $x=mssql_query("Select Count(*) As N From master..syslogins Where name=".mssql_escape($CFG->AD->Domain."\\".$CFG->params->u),
    $CFG->Directum->h);
 $y=mssql_fetch_row($x);
 $y=$CFG->Directum->Entry->Login=1==$y[0];
 $N=0;
 foreach($CFG->Directum->DBs As $DB):
  mssql_select_db($DB, $CFG->Directum->h);
//  echo $CFG->params->u, "#";
//  echo "Select Count(*) As N From sysusers Where name=".mssql_escape($CFG->params->u);
  $x=mssql_query("Select Count(*) As N From MBUser Where UserLogin=".mssql_escape($CFG->params->u), $CFG->Directum->h);
  $y=mssql_fetch_row($x);
  if(1==$y[0]):
   $x=mssql_query("Select UserName as Name, UserKod As U, NeedEncode As Mode, UserStatus As X From MBUser Where UserLogin=".
    mssql_escape($CFG->params->u), $CFG->Directum->h);
   $y='User'.$N;
   $ee=$CFG->Directum->Entry->$y=mssql_fetch_object($x);
 
   $x=mssql_query("Select Count(*) As N From sysusers Where name=".mssql_escape($ee->U), $CFG->Directum->h);
   $y=mssql_fetch_row($x);
   $x='Role'.$N;
   $CFG->Directum->Entry->$x=1==$y[0];
  endif;
  $N++;
 endforeach;
}

?>
