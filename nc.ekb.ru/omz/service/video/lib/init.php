<?
$CFG->title='Видеонаблюдение';
$CFG->AAA=1;
if(!inGroupX('Video@uxm')) $CFG->AAA=2;
//elseif($CFG->Auth) LoadLib('setup');
?>
