<?
require('../lib/uxm.php');

uxmHeader('����������');
?>
<H1>����������</H1>
� ����� � ��������� �� ������ LAN � ����� OMZGLOBAL ���������� ������ ��������� � ������� ������ OMZGLOBAL
� ���������� �� <A hRef='/omz/stat/<?
if(strlen($_SERVER['QUERY_STRING']))
  echo '?', htmlspecialchars($_SERVER['QUERY_STRING']);
?>'>����� �����</A>.
<P>
���� ��� �������� ���� ������� ������ ���������� (<A hRef='/me/?x=mig' Target='_blank'>���������</A>), �������� ������� ������ ����� ������� ������ � ������.
<P>
����������, �������� ���� ��������.
