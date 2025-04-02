<?
if(' '==$_GET['i']):	// New
 $CFG->params->i=' ';
 $CFG->entry->Host='192.168.26.';
 $CFG->entry->user='web';
else:
 $q=mssql_query('Select * From cam Where id='.($CFG->params->i=(int)trim($_GET['i'])));
 if($r=mssql_fetch_assoc($q)):
   foreach($r as $k=>$v)
     $CFG->entry->$k=$v;
 else:
   header('Location: ./'.hRef('x', 'cameras', 'i'));
   exit;
 endif;
endif;

?>
