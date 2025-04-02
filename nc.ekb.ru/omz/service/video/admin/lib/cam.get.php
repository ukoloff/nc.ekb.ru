<?
$q=mssql_query('Select [order] From o2c Where cam='.$CFG->params->i);
while($r=mssql_fetch_row($q)):
 $k='o'.$r[0];
 $CFG->entry->$k=1;
endwhile;
?>
