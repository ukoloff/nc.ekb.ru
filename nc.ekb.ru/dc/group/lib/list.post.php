<?
LoadLib('/ldapmod');

// Загружаем имена объектов и признак удаления
$CFG->entry->ocount=(int)$_POST['ocount'];
for($i=$CFG->entry->ocount-1; $i>=0; $i--):
  $Name="o$i";
  $ug=$CFG->entry->$Name=trim($_POST[$Name]);
  $xName="x$Name";
  if($CFG->entry->$xName=trim($_POST[$xName])) continue;
  $dn=id2dn($ug);
  if(!$dn) continue;
  if(ldapGroupAdd($CFG->gdn, $dn, true)) continue;			// Удаление
  $CFG->Errors->$Name=$CFG->ldapError;
endfor;

if($ug=$CFG->entry->add=trim($_POST['add'])):
 $dn=id2dn($ug);
 if(!$dn)
  $CFG->Errors->add='Нет такого пользователя/группы';
 elseif(!ldapGroupAdd($CFG->gdn, $dn))
  $CFG->Errors->add=$CFG->ldapError;
endif;

if(!$CFG->Errors)
  Header("Location: ./".hRef());

?>
