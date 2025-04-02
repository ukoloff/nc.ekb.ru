<?
global $CFG;
require_once(dirname(__FILE__).'/dummy.connect.php');
$CFG->odbt=odbtp_connect('dbserv', 'FileDSN=D:/Misc/VOXR/'.$CFG->params->x.'.dsn');
?>
