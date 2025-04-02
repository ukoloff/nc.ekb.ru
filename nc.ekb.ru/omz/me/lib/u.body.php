<?
if(!$CFG->Auth):
 LoadLib('auth');
 return;
endif;

LoadLib('/userInfo');
userInfo($CFG->u, 1);
?>
