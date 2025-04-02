<? 
$lib='common.body';
if(isset($_REQUEST['dept']))$lib=$CFG->params->x.'.dept';
if(isset($_REQUEST['login']))$lib=$CFG->params->x.'.login';
LoadLib($lib);
?>
