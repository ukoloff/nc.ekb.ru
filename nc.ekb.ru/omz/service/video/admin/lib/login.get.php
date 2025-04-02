<?
if(' '==$_GET['i']):	// New
 $CFG->params->i=' ';
else:
 $q=mssql_query('Select * From login Where id='.($CFG->params->i=(int)trim($_GET['i'])));
 if($r=mssql_fetch_assoc($q)):
   foreach($r as $k=>$v)
     $CFG->entry->$k=$v;
 else:
   header('Location: ./'.hRef('x', 'logins', 'i'));
   exit;
 endif;
endif;
?>
