<?
require('../lib/uxm.php');

$CFG->params->u=trim($_REQUEST['u']);

if(inGroupX('#Statistics')):
 $CFG->Who=2;					// Просмотр всей статистики
// LoadLib('extra');
// $CFG->extraUsers=Array();
elseif(inGroupX('#StatisticsOU')):
 $CFG->Who=1;					// Просмотр статистики подразделения
 $CFG->$odn=new dn(user2dn($CFG->u));
 $CFG->odn->Cut();
 $CFG->ou=$CFG->odn->ufn();	// Только этого поддерева
 if($CFG->params->u and !isInOU($CFG->params->u)):
   unset($CFG->params->u);
 endif;
else:
 $CFG->Who=0;					// Только своя статистика
 $CFG->params->u=$CFG->defaults->u=$CFG->u;
endif;

function isInOU($u)
{
 global $CFG;
 $udn=user2dn($u);
 if(!$udn) return;
 return $CFG->odn->isParentOf($udn);
}

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

function min2h($m)
{
 if($m<60) return "$m'";
 else return sprintf("%d:%02d'", floor($m/60), $m%60);
}

LoadLib('/tabs');
LoadLib('/mysql');
LoadLib($CFG->mode=($CFG->params->u? 'user' : 'list'));

tabsBeforeBody();
uxmHeader('Статистика &gt; '.$CFG->MonthName.' &gt; '.$CFG->tabs[$CFG->params->x]);

?>
<H1><?= $CFG->MonthName ?></H1>
<?
 tabsHeader();
 echo "\n<Center>\n";
 $f="./lib/".$CFG->mode.".".$CFG->params->x.".php";
 if(file_exists($f)) require($f);
 
 if('user'==$CFG->mode and $CFG->Who)
  echo '<BR />&raquo;<A hRef="./', hRef('u', null), '">Список пользователей</A>&laquo;';

 echo "\n</Center>\n";
 tabsFooter();
?>
</body></html>
