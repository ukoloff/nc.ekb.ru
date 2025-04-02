<?
global $CFG;

if(isset($_GET['i'])) LoadLib('load');
else $CFG->dropSession=1;
?>
