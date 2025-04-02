<?
$s=$CFG->WiFi->db->prepare("Select id, Disable, `int`, ext, maxConn From user Where u=?");
$s->execute(Array($CFG->params->u));
$r=$s->fetchObject();

if(!$r):
 $r->Disable=1;
 $r->int=1;
 $r->ext=0;
 $r->maxConn=1;
else:
 $CFG->WiFi->user=$r->id;
endif;

foreach($r as $k=>$v) $CFG->entry->$k=$v;
?>