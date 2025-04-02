<?
if(!isset($_GET[i])) return;

if(' '==$_GET[i]):
 $CFG->params->i=' ';
 $CFG->entry->int=1;
 $CFG->entry->maxConn=1;
 $CFG->entry->date=date('d.m.Y');
 $CFG->entry->time='23:59';
 return;
endif;

$s=$CFG->WiFi->db->prepare("Select *, Date_Format(xtime, '%d.%m.%Y') As date, Date_Format(xtime, '%H:%i') As time From ticket Inner Join user Using(id) Where id=?");
$s->execute(Array(trim($_GET[i])));
$s=$s->fetchObject();
if(!$s) return;
$CFG->params->i=$s->id;
$CFG->entry=$s;
?>