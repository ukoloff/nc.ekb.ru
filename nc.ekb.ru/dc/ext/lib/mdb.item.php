<?
global $CFG;

$q=odbtp_query("Select * From Users Left Join Groups On Users.GroupPtr=Groups.GroupPtr Where UserPtr=".$CFG->i,
    $CFG->odbt);
$r=odbtp_fetch_assoc($q);

$CFG->Attrs[]=Array('Name'=>'Фамилия', 'Value'=>$r['Фамилия'], 'Field'=>'sn');
$CFG->Attrs[]=Array('Name'=>'Имя', 'Value'=>$r['Имя'], 'Field'=>'givenName');
$CFG->Attrs[]=Array('Name'=>'Отчество', 'Value'=>$r['Отчество'], 'Field'=>'middleName');
$CFG->Attrs[]=Array('Name'=>'Подразделение', 'Value'=>$r['Name']);
$CFG->Attrs[]=Array('Name'=>'Число зверя', 'Value'=>$r['Number']);

$S=trim($r['Details1']);
if(preg_match('/^\d{3,}/', $S, $TabNo)):
  $CFG->Attrs[]=Array('Name'=>'Табельный номер(?)', 'Value'=>$TabNo[0], 'Field'=>'employeeID');
  $S=preg_replace('/^\d+\s*/', '', $S);
endif;

foreach(preg_split('/[\r\n]+/', $S) as $S):
 $S=trim($S);
 if(strlen($S)<=0) continue;
 if($i++)
   $CFG->Attrs[]=Array('Name'=>'Дополнительно-'.$i, 'Value'=>$S);
 else 
  $CFG->Attrs[]=Array('Name'=>'Должность(?)', 'Value'=>$S, 'Field'=>'title');
endforeach;

$CFG->Attrs[]=Array('Name'=>'Действителен до', 'Value'=>strftime('%x', $r['ExpiryDate']));
$CFG->Attrs[]=Array('Name'=>'Крайний проход', 'Value'=>strftime('%x %X', $r['LastUsed']));
$CFG->Attrs[]=Array('Name'=>'Через', 'Value'=>$r['LastUsedRdrName']);

if(file_exists($_SERVER['DOCUMENT_ROOT'].($fn="/img/photo/".$TabNo[0].".jpg")))
  $CFG->Attrs[]=Array('Name'=>'Фотка', 'Value'=>'Есть', 'Field'=>'imgURL', 'X-Value'=>'file/'.$TabNo[0], 'URL'=>$fn);

    
?>
