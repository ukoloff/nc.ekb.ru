<?
if($CFG->Auth):
 LoadLib('/user');
 userInfo($CFG->u);
else:
 echo "<Center>��� ��������� �������� � ����, ���������� <A hRef='/?login'>������������������</A> � �������...</Center>";
endif;
?>
