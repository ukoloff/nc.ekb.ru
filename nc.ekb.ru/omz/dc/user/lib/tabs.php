<?
if($CFG->udn):
 LoadLib('../ufn');
 prettyUfn($CFG->udn, $CFG->params->u);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
