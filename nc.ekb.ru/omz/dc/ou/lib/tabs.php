<?
if($CFG->odn):
 LoadLib('../ufn');
 prettyUfn($CFG->odn);
endif;
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
