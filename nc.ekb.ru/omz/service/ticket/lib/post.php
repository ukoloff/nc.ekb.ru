<?
LoadLib('/dc/user/wifi.post.online');
if(isset($_POST[rehash])) return LoadLib('post.rehash');

if(' '==$_POST[i]):
 $CFG->params->i=' ';
else:
 $s=$CFG->WiFi->db->prepare("Select id From ticket Inner Join user Using(id) Where id=?");
 $s->execute(Array($_POST[i]));
 $s=$s->fetchObject();
 if(!$s):
  header('Location: ./');
  exit;
 endif;
 $CFG->params->i=$s->id;
endif;

foreach($_POST as $k=>$v) $CFG->entry->$k=trim($v);

if(!preg_match('/^(\d+)\.(\d+)\.(\d{4})$/', $CFG->entry->date, $match) or !checkdate($match[2], $match[1], $match[3]))
  $CFG->Errors->date='Неверная дата';

if(!preg_match('/^(\d+):(\d+)$/', $CFG->entry->time, $match) or $match[1]>23 or $match[2]>59)
  $CFG->Errors->time='Неверное время';

if(!$CFG->Errors):
 $CFG->entry->xtime=join('-', array_reverse (explode('.', $CFG->entry->date))).' '.$CFG->entry->time.':00';
 $s=$CFG->WiFi->db->prepare("Select ?>Now() as Future");
 $s->execute(Array($CFG->entry->xtime));
 if(!$s->fetchObject()->Future)
   $CFG->Errors->date='В прошлом';
endif;

if(!preg_match('/^\d*$/', $CFG->entry->maxConn))
  $CFG->Errors->maxConn='Число?';

if($CFG->Errors) return;

foreach(explode(' ', 'Disable int ext')as $k) $Z[$k]=!!$CFG->entry->$k;
$Z[maxConn]=strlen($CFG->entry->maxConn)? $CFG->entry->maxConn : null;
if(' '==$CFG->params->i) $Z[u]=findVUser();

$SQL=(' '==$CFG->params->i?'Insert Into':'Update')." user Set\n mtime=Now()";
foreach($Z as $k=>$v) $SQL.=",\n `$k`=:$k";
$SQL.=' '==$CFG->params->i? ",\n ctime=Now()" : "\nWhere id=:id";
if(' '!=$CFG->params->i) $Z[id]=$CFG->params->i;

$s=$CFG->WiFi->db->prepare($SQL);
$s->execute($Z);
unset($Z);
$Z[id]=' '!=$CFG->params->i? $CFG->params->i : $CFG->WiFi->db->lastInsertId();
$Z[xtime]=$CFG->entry->xtime;
$Z[Notes]=$CFG->entry->Notes;
if(' '==$CFG->params->i)$Z[creator]=$CFG->u;

$s=$CFG->WiFi->db->prepare((' '!=$CFG->params->i? "Update":"Insert Into")." ticket Set xtime=:xtime, Notes=:Notes".
 (' '!=$CFG->params->i? "\nWhere" : ", hash=LAST_INSERT_ID(), creator=:creator,")." id=:id");
$s->execute($Z);

header('Location: ./?i='.$Z[id]);

function findVUser()
{
 global $CFG;
 $s=$CFG->WiFi->db->query("Select 1+Length(Count(*)) As L From ticket Inner Join user Using(id)");
 $N=max(3, $s->fetchObject()->L);
 $s=$CFG->WiFi->db->prepare("Select Count(*) As N From user Where u=");
 while(1)
 {
  $u='#';
  while(strlen($u)<=$N) $u.=chr(ord('0')+rand(0, 9));
  $s->execute(Array($u));
  if(!$s->fetchObject()->N) return $u;
 }
}

?>
