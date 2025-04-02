<?
loadLib('wifi.post.online');

foreach(explode(' ', 'int ext Disable')as $k) $CFG->entry->$k=trim($_POST[$k])?1:0;

if(!preg_match('/^\d*$/', $CFG->entry->maxConn=trim($_POST[maxConn]))):
 $CFG->Errors->maxConn='Требуется число';
 return;
endif;

$s=$CFG->WiFi->db->prepare("Select id From WiFi.user Where u=?");
$s->execute(Array($CFG->params->u));
$id=$s->fetchObject()->id;

foreach($CFG->entry as $k=>$v) $Z[$k]=$v;

if(!strlen($Z[maxConn])) $Z[maxConn]=null;
if($id)
 unset($Z[u]);
else
 $Z[u]=$CFG->params->u;

$SQL='';
foreach($Z as $k=>$v) $SQL.=",\n `$k`=:$k";

if($id):
 $SQL.="\nWhere id=:id";
 $Z[id]=$id;
else:
  $SQL.=",\n ctime=Now()";
endif;

$SQL=($id? "Update" : "Insert Into")." user\nSet\n mtime=Now()".$SQL;

$s=$CFG->WiFi->db->prepare($SQL);
$s->execute($Z);

header('Location: ./'.hRef());
?>