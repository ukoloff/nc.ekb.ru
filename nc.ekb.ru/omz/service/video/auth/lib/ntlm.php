<?
if('video.uxm'!=$CFG->u) return $CFG->AAA=2;

function extractUser()
{
 global $CFG;
 list($d, $u)=explode("\\", trim($_POST['u']), 2);
 if(strtolower(trim($d))!=strtolower($CFG->AD->Domain)) return;
 $u=trim($u);
 if(!strlen($u)) return;
 if(!inGroupX('Video@uxm', $u)) return;
 return $u;
}

$u=extractUser();
if(!strlen($u)) exit;
$r=doAuth($u, $_POST['IP'], $_POST['ua'], 'n');
Header("X-Ticket: $r");
exit;

?>
