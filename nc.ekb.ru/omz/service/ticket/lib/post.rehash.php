<?
LoadLib('rehash');
$X=newTicket();
if($X):
 $s=$CFG->WiFi->db->prepare("Update ticket Set hash=:hash Where id=:id");
 $s->execute(Array(hash=>$X->h, id=>$_POST[rehash]));
 $s=$CFG->WiFi->db->prepare("Update user Set mtime=Now() Where id=?");
 $s->execute(Array($_POST[rehash]));
else:
 $X->t='#бсющ';
endif;
?>
<Script><!--
parent.Rehashed(<?=jsEscape($X->t)?>);
location='0/';
//--></Script>
AAA
<? exit; ?>