<? 
LoadLib('/pfx'); 

//if(!$CFG->AAA)$CFG->AAA=1;

//$CFG->rsa->Creator=$CFG->params->u? inGroupX('CA@uxm') : $CFG->Auth;
$CFG->rsa->Creator=$CFG->params->u? inGroupX('CA@uxm') : 0;
$CFG->rsa->u=$CFG->params->u;
if(!$CFG->rsa->u)$CFG->rsa->u=$CFG->u;
?>
