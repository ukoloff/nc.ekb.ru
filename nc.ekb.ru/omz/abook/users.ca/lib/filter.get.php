<?
$CFG->ops=Array(
'^'=>'Начинается с',
'='=>'Равно',
':'=>'Содержит',
'$'=>'Заканичвается на',
'-'=>'Пусто',
'@'=>'NULL'
);

$CFG->q=parseFilter($CFG->params->q=trim($_GET[q]));
buildFilter();

function parseFilter($f)
{
 global $CFG;
 $R=Array();
 $l='';
 while(strlen($f)):
  $Q=preg_split('/([\\\\;])/', $f, 2, PREG_SPLIT_DELIM_CAPTURE);
  $l.=$Q[0]; $f=$Q[2];
  if("\\"!=$Q[1]){ $R[]=$l; $l=''; continue; }
  $l.=$f{0}; 
  $f=substr($f, 1);
 endwhile;
 if(strlen($l))$R[]=$l;
 $F=Array();
 foreach($R as $x):
  $s=$x{0}; $x=substr($x, 1);
  if(!s or !$CFG->sort[$s])continue;
  $not='!'==$x{0}; if($not) $x=substr($x, 1);
  $o=$x{0}; $x=substr($x, 1);
  if(!$CFG->ops[$o]) continue;
  if(preg_match('/[-@]/', $o)) unset($x);
  unset($Y);
  $Y->s=$s;
  $Y->not=$not;
  $Y->o=$o;
  $Y->v=$x;
  $F[]=$Y;
 endforeach;
 return array_reverse($F);
}

function buildFilter()
{
 global $CFG;
 $S='';
 foreach($CFG->q as $z):
  $S.="\nAnd ";
  if($z->not) $S.='Not ';
  $S.=$CFG->sort[$z->s][field];
  $v=SQLite3::escapeString($z->v);
  switch($z->o){
   case '=': $S.="='$v'"; break;
   case '^': $S.=" Like '$v%'"; break;
   case '$': $S.=" Like '%$v'"; break;
   case ':': $S.=" Like '%$v%'"; break;
   case '-': $S.="=''"; break;
   case '@': $S.=" is NULL"; break;
  }
 endforeach;
 $CFG->SQL="\nFrom Certs Left Join Attrs On Certs.id=Attrs.id Where u is not NULL".$S."\n".sqlOrderBy();
}

?>
