<?
global $CFG;

$q=odbtp_query("Select * From worker Left Join dept On worker.cod=dept.cod Where tab_num=".$CFG->i,
    $CFG->odbt);
$r=odbtp_fetch_assoc($q);
$CFG->Attrs[]=Array('Name'=>'��������� �����', 'Value'=>$r['tab_num'], 'Field'=>'employeeID');
$CFG->Attrs[]=Array('Name'=>'�������', 'Value'=>$r['fam'], 'Field'=>'sn');
$CFG->Attrs[]=Array('Name'=>'���', 'Value'=>$r['im'], 'Field'=>'givenName');
$CFG->Attrs[]=Array('Name'=>'��������', 'Value'=>$r['ot'], 'Field'=>'middleName');
$CFG->Attrs[]=Array('Name'=>'�������������', 'Value'=>$r['dept']);
$i=0;
foreach(preg_split('/[\r\n]+/', $r['dop_sv']) as $S):
 $S=trim($S);
 if(strlen($S)<=0) continue;
 if($i++)
   $CFG->Attrs[]=Array('Name'=>'�������������-'.$i, 'Value'=>$S);
 else 
  $CFG->Attrs[]=Array('Name'=>'���������(?)', 'Value'=>$S, 'Field'=>'title');
endforeach;
$CFG->Attrs[]=Array('Name'=>'������� �����', 'Value'=>strftime('%x', $r['d_vidan']));
$CFG->Attrs[]=Array('Name'=>'������������ ��', 'Value'=>strftime('%x', $r['d_srok']));
if($r['block'])
$CFG->Attrs[]=Array('Name'=>'������������', 'Value'=>strftime('%x', $r['d_block']));

if(file_exists($_SERVER['DOCUMENT_ROOT'].($fn="/img/photo/".$r['tab_num'].".jpg")))
  $CFG->Attrs[]=Array('Name'=>'�����', 'Value'=>'����', 'Field'=>'imgURL', 'X-Value'=>'file/'.$r['tab_num'], 'URL'=>$fn);
//print_r($r);
?>

