<?
function checkNewUser()
{
 global $CFG;
 $u=trim($_REQUEST['u']);

 if(!strlen($u)) return "��� �� �������!";
 if(!preg_match('/^[-\da-z_.]+$/i', $u)) return "������������ ������� � �����!";
 if(id2dn($u)) return "����� ������������ ��� ����������!";
 return "��� <B>�����</B> ������������";
}

?>
