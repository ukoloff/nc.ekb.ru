<?
global $CFG;
require("../../lib/uxm.php");

uxmHeader('������������ ������');
?>
<H1>������������ ������</H1>
� ����� �:
<OL>
<LI>�������������
<LI>����������
<LI>��������� �� ������ LAN � ����� OMZGLOBAL
<LI>� ����� ����, ��� ����������� ������ ;-)
</OL>
������ � ������������ �������� �������� �� <A hRef='/omz/service/rdp/<? 
if(strlen($_SERVER['QUERY_STRING']))
  echo '?', htmlspecialchars($_SERVER['QUERY_STRING']);
?>'>����� �����</A>.
<P>
�������� ���� �������� <span style='background: yellow;'>���� �������</span>.
</body></html>
