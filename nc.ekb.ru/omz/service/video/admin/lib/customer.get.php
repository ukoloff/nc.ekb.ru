<?
if(' '==$_GET['i']):	// New
 $CFG->params->i=' ';
else:
 $q=mssql_query('Select * From customer Where id='.($CFG->params->i=(int)trim($_GET['i'])));
 if($r=mssql_fetch_assoc($q)):
   foreach($r as $k=>$v)
     $CFG->entry->$k=$v;
   $q=mssql_query('Select [order] From c2o Where customer='.$CFG->params->i);
   while($r=mssql_fetch_row($q)):
    $k='o'.$r[0];
    $CFG->entry->$k=1;
   endwhile;
 else:
   header('Location: ./'.hRef('x', 'customers', 'i'));
   exit;
 endif;
endif;
?>
