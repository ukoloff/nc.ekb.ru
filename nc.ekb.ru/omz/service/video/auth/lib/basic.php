<?
if(!inGroupX('Video@uxm')):
 $CFG->AAA=2;
 Header('Refresh: 0; URL="http://video.ekb.ru/i/?x"');
 return;
endif;

$r=doAuth($CFG->u, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
Header("Location: http://video.ekb.ru/i/?x=".urlencode($r));
exit;

?>
