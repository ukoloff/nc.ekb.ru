<?
LoadLib('/tabs');

$CFG->defaults->list='<none>';

if(inGroupX('#Statistics')):
 $CFG->Who=2;					// Просмотр всей статистики
/*
elseif(inGroupX('#StatisticsOU')):
 $CFG->Who=1;					// Просмотр статистики подразделения
 $CFG->$odn=new dn(user2dn($CFG->u));
 $CFG->odn->Cut();
 $CFG->ou=$CFG->odn->ufn();	// Только этого поддерева
*/
else:
 $CFG->Who=0;					// Только своя статистика
endif;

LoadLib(($CFG->Who and isset($_REQUEST['list']))? 'list':'user');
$CFG->H1=$CFG->title;
$CFG->title.=' ['.tabName().']';

function n2M($n)
{
 $S=strtr(sprintf("%.1f", $n/(1024*1024)), '.', ',');
 return '0.0'==$S ? '' : $S;
}

function n2M0($n)
{
 $n=n2M($n);
 if('0,0'==$n)unset($n);
 return $n;
}

function b2k($N)
{
  if($N<1000) return $N;
  $N=$N/1024;
  if($N<1000) return sprintf("%0.1fk", $N);
  $N=$N/1024;
  if($N<1000) return sprintf("%0.1fM", $N);
   return sprintf("%0.1fG", $N/1024);
}

?>
