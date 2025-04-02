<?
if($CFG->udn) $CFG->ldn=$CFG->udn;
elseif($CFG->gdn) $CFG->ldn=$CFG->gdn;
elseif($CFG->odn) $CFG->ldn=$CFG->odn->str();
else return;
?>
