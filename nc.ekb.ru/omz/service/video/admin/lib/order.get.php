<?
if(' '==$_GET['i']):	// New
 $CFG->params->i=' ';
else:
 $q=mssql_query('Select * From orders Where id='.($CFG->params->i=(int)trim($_GET['i'])));
 if($r=mssql_fetch_assoc($q)):
   foreach($r as $k=>$v)
     $CFG->entry->$k=$v;
   $q=mssql_query('Select cam From o2c Where [order]='.$CFG->params->i);
   while($r=mssql_fetch_row($q)):
     $k='c'.$r[0];
     $CFG->entry->$k=1;
   endwhile;
 else:
   header('Location: ./'.hRef('x', 'customers', 'i'));
   exit;
 endif;
endif;
?>
