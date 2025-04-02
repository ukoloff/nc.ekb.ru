<?
function Rehash($ticket)
{
 global $CFG;
 $s=$CFG->WiFi->db->prepare("Insert Into rehash(ticket) Values(?)");
 $s->execute(Array($ticket));
 $N=$CFG->WiFi->db->lastInsertId();
 file_get_contents('http://wifi.ekb.ru/control/rehash/');
 $s=$CFG->WiFi->db->prepare("Select hash From rehash Where id=?");
 $s->execute(Array($N));
 $h=$s->fetchObject()->hash;
 $s=$CFG->WiFi->db->prepare("Delete From rehash Where id=?");
 $s->execute(Array($N));
 return $h;
}

function newTicket()
{
 global $CFG;
 $s=$CFG->WiFi->db->prepare("Select * From ticket Where hash=?");
 $N=0;
 do{
  if($N++>5) return;
  for($T=''; strlen($T)<9; $T.=chr(ord('0')+rand(0, 9)));
  $T=join('-', str_split($T, 3));
  $s->execute(Array($H=Rehash($T)));
 }while($s->fetchObject());
 $R->t=$T; 
 $R->h=$H;
 return $R;
}
?>