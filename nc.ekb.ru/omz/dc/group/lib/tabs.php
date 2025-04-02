<?
if($CFG->gdn):
 LoadLib('../ufn');
 prettyUfn($CFG->gdn, $CFG->params->g);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
