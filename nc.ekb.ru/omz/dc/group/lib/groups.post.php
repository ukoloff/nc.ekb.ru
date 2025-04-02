<?
LoadLib('/ADx');

// Загружаем имена групп и признак удаления
$CFG->entry->gcount=(int)$_POST['gcount'];
for($i=$CFG->entry->gcount-1; $i>=0; $i--):
  $Name="g$i";
  $g=$CFG->entry->$Name=trim($_POST[$Name]);
  $xName="x$Name";
  if($CFG->entry->$xName=trim($_POST[$xName])) continue;
  $gdn=group2dn($g);
  if(!$gdn) continue;
  if(ldapGroupAdd($gdn, $CFG->idn, true)) continue;	// Удаление
  $CFG->Errors->$Name==$CFG->ldapError;
endfor;

if($g=$CFG->entry->add=trim($_POST['add'])):
 $gdn=group2dn($g);
 if(!$gdn)
  $CFG->Errors->add='Нет такой группы';
 elseif(!ldapGroupAdd($gdn, $CFG->idn))
  $CFG->Errors->add=$CFG->ldapError;
endif;

if(!$CFG->Errors)
  Header("Location: ./".hRef());

?>
