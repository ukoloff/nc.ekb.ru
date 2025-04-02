<?
$CFG->entry->c=trim($_REQUEST['c']);
if(!$CFG->isNew):
 $q=ldap_search($CFG->h, $CFG->Base, 
    "(&(objectClass=sendmailMTAClass)(sendmailMTAHost=".str2ldap($CFG->Sendmail->Domain).
    ")(sendmailMTAClassName=".str2ldap($CFG->entry->c)."))", Array());

 if(1==ldap_count_entries($CFG->h, $q)):
  $CFG->params->cn=$CFG->entry->c;
  
  $e=ldap_get_entries($CFG->h, $q);
  $e=getEntry($e[0]['dn'], 'description info sendmailMTAClassValue');
  $CFG->entry->description=utf2str($e['description'][0]);
  $CFG->entry->info=utf2str($e['info'][0]);
  $x=$e['sendmailmtaclassvalue'];
  $xx='';
  for($i=0; $i<$x['count']; $i++)
    $xx.=utf2str($x[$i])."\r\n";
  $CFG->entry->items=$xx;
 else:
  $CFG->Error='Класс не найден';
 endif;
endif;
?>
