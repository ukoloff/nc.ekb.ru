<?
global $CFG;

$q=odbtp_query("Select * From Users Left Join Groups On Users.GroupPtr=Groups.GroupPtr Where UserPtr=".$CFG->i,
    $CFG->odbt);
$r=odbtp_fetch_assoc($q);

$CFG->Attrs[]=Array('Name'=>'�������', 'Value'=>$r['�������'], 'Field'=>'sn');
$CFG->Attrs[]=Array('Name'=>'���', 'Value'=>$r['���'], 'Field'=>'givenName');
$CFG->Attrs[]=Array('Name'=>'��������', 'Value'=>$r['��������'], 'Field'=>'middleName');
$CFG->Attrs[]=Array('Name'=>'�������������', 'Value'=>$r['Name']);
$CFG->Attrs[]=Array('Name'=>'����� �����', 'Value'=>$r['Number']);

$S=trim($r['Details1']);
if(preg_match('/^\d{3,}/', $S, $TabNo)):
  $CFG->Attrs[]=Array('Name'=>'��������� �����(?)', 'Value'=>$TabNo[0], 'Field'=>'employeeID');
  $S=preg_replace('/^\d+\s*/', '', $S);
endif;

foreach(preg_split('/[\r\n]+/', $S) as $S):
 $S=trim($S);
 if(strlen($S)<=0) continue;
 if($i++)
   $CFG->Attrs[]=Array('Name'=>'�������������-'.$i, 'Value'=>$S);
 else 
  $CFG->Attrs[]=Array('Name'=>'���������(?)', 'Value'=>$S, 'Field'=>'title');
endforeach;

$CFG->Attrs[]=Array('Name'=>'������������ ��', 'Value'=>strftime('%x', $r['ExpiryDate']));
$CFG->Attrs[]=Array('Name'=>'������� ������', 'Value'=>strftime('%x %X', $r['LastUsed']));
$CFG->Attrs[]=Array('Name'=>'�����', 'Value'=>$r['LastUsedRdrName']);

if(file_exists($_SERVER['DOCUMENT_ROOT'].($fn="/img/photo/".$TabNo[0].".jpg")))
  $CFG->Attrs[]=Array('Name'=>'�����', 'Value'=>'����', 'Field'=>'imgURL', 'X-Value'=>'file/'.$TabNo[0], 'URL'=>$fn);

    
?>
