<?
$CFG->entry->comment=trim($_POST['comment']);
mssql_query('Update cam  Set comment='.dbEscape($CFG->entry->comment).' Where id='.$CFG->params->i);

$L='';
foreach($_POST as $k=>$v)
 if(preg_match('/^o(\d+)$/', $k, $match)):
  $CFG->entry->$k=!!$v;
  $L.=', '.$match[1];
 endif;
$L=strlen($L)? substr($L, 2) : "''";

mssql_query(<<<SQL
Delete From o2c Where cam={$CFG->params->i} And Not [order] in($L)
Insert Into o2c(cam, [order])
 Select {$CFG->params->i}, orders.id
    From orders Left Join o2c On orders.id=o2c.[order] And o2c.cam={$CFG->params->i}
    Where orders.id in($L) And o2c.cam Is Null
SQL
);

Header('Location: ./'.hRef());
?>
