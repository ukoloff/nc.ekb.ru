<?
global $CFG;

if(($CFG->entry->Login=!!$_POST['Login'])!=!!$CFG->Directum->Entry->Login)
  mssql_query('sp_'.($CFG->entry->Login? 'grant':'revoke').'login '.mssql_escape($CFG->AD->Domain."\\".$CFG->params->u),
    $CFG->Directum->h);

$N=0;
foreach($CFG->Directum->DBs as $DB):
 $x='Role'.$N;
 $xx='User'.$N;
 if(($CFG->entry->$x=!!$_POST[$x])!=!!$CFG->Directum->Entry->$x):
  mssql_select_db($DB);
  mssql_query(
    ($CFG->entry->$x? 'sp_adduser '.mssql_escape($CFG->AD->Domain."\\".$CFG->params->u).', ' : 'sp_dropuser ').
    mssql_escape($CFG->Directum->Entry->$xx->U),
    $CFG->Directum->h);
 endif;
 $N++;
endforeach;

Header('Location: ./'.hRef());

?>
