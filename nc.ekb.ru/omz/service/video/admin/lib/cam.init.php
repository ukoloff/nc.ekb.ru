<?
$r=mssql_fetch_assoc(mssql_query('Select * From cam Where id='.($CFG->params->i=(int)trim($_REQUEST['i']))));
if(!$r):
 header('Location: ./'.hRef('x', 'cameras', 'i'));
 exit;
endif;
foreach($r as $k=>$v)$CFG->entry->$k=$v;
?>
