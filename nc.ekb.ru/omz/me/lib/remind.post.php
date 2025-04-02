<?
$u=AddSlashes($CFG->u);

if($_POST[mark]):
  mysql_query("Update remind Set Seen=Now() Where u='$u' And xtime<Now() And Seen Is Null And Disable=0");
  Header('Location: ./'.hRef());
  return;
endif;

if(' '==$_POST[i]):
  $CFG->params->i=' ';
else:
 $i=(int)trim($_POST[i]);
 $i=sqlGet("Select id From remind Where xtime>Now() And u='$u' And id=$i");
 if(!$i):
  Header('Location: ./'.hRef());
  return;
 endif;
 if(trim($_POST[del])):
  mysql_query("Delete From remind Where id=$i");
  Header('Location: ./'.hRef());
  return;
 endif;
 $CFG->params->i=$i;
endif;

LoadLib('remind.request');

if(!preg_match('/^(\d+)\.(\d+)\.(\d{4})$/', $CFG->entry->date, $match) or !checkdate($match[2], $match[1], $match[3]))
  $CFG->Errors->date='Неверная дата';

if(!preg_match('/^(\d+):(\d+)$/', $CFG->entry->time, $match) or $match[1]>23 or $match[2]>59)
  $CFG->Errors->time='Неверное время';

if(strlen($CFG->entry->URL) and !preg_match('|^https?://\S+$|i', $CFG->entry->URL))
  $CFG->Errors->URL='Ссылка?';

if($CFG->Errors) return;

$Z=clone $CFG->entry;
$Z->xtime=join('-', array_reverse (explode('.', $Z->date))).' '.$Z->time.':00';
unset($Z->date);
unset($Z->time);

if(sqlGet("Select '{$Z->xtime}'<Now()")):
  $CFG->Errors->date='Прошедшее время';
  return;
endif;


if(' '==$CFG->params->i):
// Create
 $K='Insert Into remind(ctime, mtime, u';
 $V=")\nValues(Now(), Now(), '$u'";
 foreach($Z as $k=>$v):
   $K.=', '.$k;
   $V.=', '.(strlen($v)?"'".AddSlashes($v)."'":'NULL');
 endforeach;
 mysql_query($K.$V.")");
else:
 $Q="Update remind Set\n\tmtime=Now()";
 foreach($Z as $k=>$v)
   $Q.=",\n\t$k=".(strlen($v)?"'".AddSlashes($v)."'":'NULL');
 $Q.="\nWhere id=".$CFG->params->i;
 mysql_query($Q);
endif;

unset($CFG->params->i);
Header('Location: ./'.hRef());
?>