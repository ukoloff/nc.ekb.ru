<Script><!--
function setUser(x)
{
 if(x.selectedIndex<=0) return;
 x.form.login.value=x.options[x.selectedIndex].text;
 x.selectedIndex=0;
}
function Sure(B)
{
 if(!confirm('�� ����������� ������� ������������ ������ #'+B.form.i.value+
    '\n��� �������� ���������� ����� ��������.\n\n�� �������?')) return;
 B.form.i.value='#'+B.form.i.value;
 B.form.submit();
}

function Validate(F)
{
 if(!F.login.value.length)
 {
  F.login.focus();
  return false;
 }
     return true;
}
//--></Script>
<? if($CFG->Errors->General) echo '<H2 Class="Error">', htmlspecialchars($CFG->Errors->General), '</H2>'; ?>
&raquo;
������ ������������:
<?
if(!user2dn($CFG->entry->login)) echo "�� � ������";
elseif(inGroupX('Video@uxm', $CFG->entry->login)) echo "Ok", userLink();
else echo '<A hRef="/omz/dc/group/?x=list&amp;g=Video%40uxm">������������</A>', userLink();
?>
<Form Action='./' Method='POST' onSubmit='return Validate(this)'>
<Table><TR vAlign='top'><TD>
<?
HiddenInputs();
LoadLib('/forms');
Input('login', '������'); BR();
Input('cameras', '������'); BR();
Input('lists', '������ �����'); BR();
Input('comment', '�����������');
?>
<P />
<? LoadLib('buttons'); ?>
</TD><TD>
<?
$CFG->defaults->Input->extraAttr=' onChange="setUser(this)" ';
$U2=users2add();
if($U2) Select('', $U2, '������������');
unset($CFG->defaults->Input->extraAttr);
?>
</TD></TR></Table>
<? LoadLib('cams.roster'); ?>
<? LoadLib('list.roster'); ?>
</Form>
&raquo;
���� � ������� � ������� ����� ������ �� �������, ������ ������������ �������� ��� ������
<?
function users2add()
{
 global $CFG;
 $dn=group2dn('Video@uxm');
 if(!$dn) return;
 $Q[]=$dn;
 $Seen[$dn]=1; 

 $q=mssql_query('Select Distinct login From login');
 while($r=mssql_fetch_row($q))
  $U[strtolower($r[0])]=1;

// $Res[]='�������� ������������...';
 $Res=Array();
 while($m=array_pop($Q)):
  if(ldap_compare($CFG->AD->h, $m, 'objectClass', 'user')):
   if(!$U[strtolower($u=dn2user($m))])$Res[]=$u;
   continue;
  endif;
  $e=getEntry($m, 'member');
  $e=$e[$e[0]];
  for($i=$e['count']-1; $i>=0; $i--)
   if(!$Seen[$e[$i]]):
    $Seen[$e[$i]]=1;
    $Q[]=$e[$i];
   endif;
 endwhile;

 if(0==count($Res))return;
 sort($Res);
 array_unshift(&$Res, '�������� ������������...');
 return $Res;
}

function userLink()
{
 global $CFG;
 return $CFG->entry->login? ' <A hRef="/omz/abook/?u='.htmlspecialchars(urlencode($CFG->entry->login)).'">&raquo;</A>':'';
}
?>