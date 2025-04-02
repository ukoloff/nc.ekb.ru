<?
LoadLib('user.log.list');
if(isset($_GET['start'])):
 switch(strtolower(trim($_GET['start']))):
  case 'done': $S=''; LoadLib('user.log.done'); break;
  case 'evening': $S='Current_Date+Interval 1 Day-Interval 1 Hour'; break;
  case 'weekend': $S='Current_Date+Interval 7-WeekDay(Current_Date) Day-Interval 1 Hour'; break;
  case 'month': $S="Concat(Extract(Year_Month From Current_Date), '01')+Interval 1 Month-Interval 1 Hour"; break;
  default: $S='Current_Date'; 
 endswitch;
 if($S):
  mysql_query("Insert Into logOrder(u, Spy, `Trigger`) Values(".$CFG->uSQL.", '".AddSlashes($CFG->u)."', $S)");
?>
<Script><!--
location.search='<?=hRef('start', 'done')?>';
//--></Script>
<?
 endif;
else:
  LoadLib('user.log.form');
endif;
?>
