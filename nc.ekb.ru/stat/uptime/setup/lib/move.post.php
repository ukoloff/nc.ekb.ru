<?
global $CFG;

$CFG->entry->p=trim($_REQUEST['p']);
if(!$CFG->params->n):
 $CFG->Errors->p='������ ������ �����������';
elseif(!preg_match('/^\\d*$/', $CFG->entry->p)):
 $CFG->Errors->p='������� �������� ���';
else:
 for($p=$CFG->entry->p; $p; ):
  if($p==$CFG->params->n):
   $CFG->Errors->p='���������� ������� �������� �������';
   break;
  endif;
  $q=sqlite3_query($CFG->db, "Select ParentNo From Tests Where No=$p");
  $r=sqlite3_fetch($q);
  sqlite3_query_close($q);
  if(!$r):
   $CFG->Errors->p='������ �� ������';
   break;
  endif;
  $p=$r[0];
 endfor;
endif;

if(!$CFG->Errors->p):
 if(sqlite3_exec($CFG->db, "Update Tests Set ParentNo=".($CFG->entry->p? $CFG->entry->p: 'NULL').
    " Where No=".$CFG->params->n)):
  Header('Location: ./'.hRef());
 else:
  $CFG->Errors->p='������ SQL: '.sqlite3_error($CFG->db);
 endif;
endif;

?>
