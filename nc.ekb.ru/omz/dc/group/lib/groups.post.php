<?
LoadLib('/ADx');

// ��������� ����� ����� � ������� ��������
$CFG->entry->gcount=(int)$_POST['gcount'];
for($i=$CFG->entry->gcount-1; $i>=0; $i--):
  $Name="g$i";
  $g=$CFG->entry->$Name=trim($_POST[$Name]);
  $xName="x$Name";
  if($CFG->entry->$xName=trim($_POST[$xName])) continue;
  $gdn=group2dn($g);
  if(!$gdn) continue;
  if(ldapGroupAdd($gdn, $CFG->idn, true)) continue;	// ��������
  $CFG->Errors->$Name==$CFG->ldapError;
endfor;

if($g=$CFG->entry->add=trim($_POST['add'])):
 $gdn=group2dn($g);
 if(!$gdn)
  $CFG->Errors->add='��� ����� ������';
 elseif(!ldapGroupAdd($gdn, $CFG->idn))
  $CFG->Errors->add=$CFG->ldapError;
endif;

if(!$CFG->Errors)
  Header("Location: ./".hRef());

?>
