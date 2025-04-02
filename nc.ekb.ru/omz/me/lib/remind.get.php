<?
if(' '==$_GET[i]):
 $CFG->params->i=' ';
 $CFG->entry->URL=$_SERVER[HTTP_REFERER];
 $CFG->entry->mail=1;
 $CFG->entry->date=date('d.m.Y');
 $CFG->entry->time='23:59';
 LoadLib('remind.request');
 return;
endif;

$i=(int)trim($_GET[i]);
$u=AddSlashes($CFG->u);
$q=mysql_query("Select *, Date_Format(xtime, '%d.%m.%Y') As date, Date_Format(xtime, '%H:%i') As time, Now()>xtime As Gone From remind Where id=$i And u='$u'");
$r=mysql_fetch_object($q);
if(!$r) return;

foreach($r as $k=>$v) $CFG->entry->$k=$v;
$CFG->params->i=$CFG->entry->id;

if($CFG->entry->Gone and ! $CFG->entry->Seen)
  mysql_query("Update remind Set Seen=Now() Where id=".$CFG->entry->id);

if(isset($_GET[go]) and $CFG->entry->URL)
  Header('Location: '.$CFG->entry->URL);
?>