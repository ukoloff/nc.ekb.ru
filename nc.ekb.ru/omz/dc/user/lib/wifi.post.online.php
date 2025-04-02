<?
if(!isset($_POST[Drop])) return;

$s=$CFG->WiFi->db->prepare("Insert Ignore Into stop(id, Reason, Info) Values(:id, '!', :Info)");
$s->execute(Array(id=>(int)trim($_POST[Drop]), Info=>$CFG->u));
header('Location: 0/');
exit;
?>