<?
function dcUser()
{
 global $CFG;
 $u=trim($_REQUEST['u']);

 if(!strlen($u)) return "��� �� �������!";
 if(!preg_match('/^[-\da-z_.]+$/i', $u)) return "������������ ������� � �����!";
 if(user2dn($u)) return "����� ������������ ��� ����������!";
 LoadLib('/socket');
 if(checkUser($u)) return "��� ������������ �������� �������� (alias?)!";
 return "��� <B>�����</B> ������������";
}
?>
