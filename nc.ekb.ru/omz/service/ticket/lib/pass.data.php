<Script><!--
ticketData={
<?
$Skip=Array(hash=>1, Notes=>1);
foreach($CFG->entry as $k=>$v)
  if(!$Skip[$k]) echo " $k:\t", jsEscape($v), ",\n";
echo " hash:\t", (int)($CFG->entry->hash==$CFG->entry->id);
?>
};
//--></Script>
