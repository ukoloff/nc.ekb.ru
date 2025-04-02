<?
if('#'==$_POST['i']{0}):	// Delete
 if(preg_match('/\d+/', $_POST['i'], $M))
   @mssql_query('Delete From customer Where ID='.$M[0]);
 header('Location: ./'.hRef('x', 'customers'));
 exit;
endif;

$CFG->params->i=(' '==$_POST['i']?' ':(int)trim($_POST['i']));

$Fld=Array(u=>0, block=>0, comment=>0, pass=>-1, mail=>0, phone=>0, org=>0, contact=>0);

foreach($Fld as $k=>$v)
  $CFG->entry->$k=trim($_POST[$k]);
$CFG->entry->block=!!$CFG->entry->block;

foreach($_POST as $k=>$v)
 if(preg_match('/^o\d+$/', $k))
  $CFG->entry->$k=!!$v;

if(!preg_match('/^[-\w]+$/', $CFG->entry->u))
  $CFG->Errors->u='Неверное имя пользователя';
if(preg_match('/\D/', $CFG->entry->pass))
  $CFG->Errors->pass='Неверный пароль';
if(' '==$CFG->params->i and !strlen($CFG->entry->pass))
  $CFG->Errors->pass='Пароль не задан';

if($CFG->Errors) return;

if(' '==$CFG->params->i):
 $S=''; $S2='';
 foreach($Fld as $k=>$v):
  if($v<0) continue;
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]";
  if(strlen($S2)) $S2.=",";
  $S2.="\n\t".dbEscape($CFG->entry->$k);
 endforeach;
 if(strlen($CFG->entry->pass)): 
   $S.=",\n\t[hash]";
   $S2.=",\n\t".dbEscape(uxmHashFiltered($CFG->entry->pass));
 endif;
 $S="Insert Into customer(".$S.")\nValues(".$S2.")";
 @mssql_query($S);
 $Err=dbError();
 if(!$Err): $CFG->params->i=dbLastId(); endif;
else:
 $S='';
 foreach($Fld as $k=>$v):
  if($v<0) continue;
  if(strlen($S)) $S.=",";
  $S.="\n\t[$k]=".dbEscape($CFG->entry->$k);
 endforeach;
 if(strlen($CFG->entry->pass))
   $S.=",\n\t[hash]=".dbEscape(uxmHashFiltered($CFG->entry->pass));
 $S="Update customer Set".$S."\nWhere id=".$CFG->params->i;
 @mssql_query($S);
 $Err=dbError();
endif;

if($Err):
  $CFG->Errors->General="SQL error #$Err!";
  return;
endif;

$L='';
foreach($CFG->entry As $k=>$v)
 if(preg_match('/^o(\d+)$/', $k, $match) and $v)
  $L.=', '.$match[1];
$L=strlen($L)? substr($L, 2) : "''";

mssql_query(<<<SQL
Delete From c2o Where customer={$CFG->params->i} And Not [order] in($L)
Insert Into c2o(customer, [order])
 Select {$CFG->params->i}, orders.id
    From orders Left Join c2o On orders.id=c2o.[order] And c2o.customer={$CFG->params->i}
    Where orders.id in($L) And c2o.customer Is Null
SQL
);

header('Location: ./'.hRef());

function uxmHash($pass)
{
 $salt1=chr(rand(0, 255)).chr(rand(0, 255));
 $salt2=chr(rand(0, 255)).chr(rand(0, 255));
 return base64_encode($salt1.pack('H*', sha1($salt1.$pass.$salt2)).$salt2);
}

function uxmHashFiltered($pass)
{
 while(!preg_match('/^\w+$/', $h=uxmHash($pass)));
 return $h;
}

?>
