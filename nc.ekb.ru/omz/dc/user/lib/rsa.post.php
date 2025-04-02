<?
if($CFG->rsa->Creator):
 pfxCall('New', $CFG->params->u);
//usleep(300000);
 sleep(1);
endif;

header('Location: ./'.hRef());
exit;
?>
