<?
require("../../../lib/uxm.php");

global $CFG;
$CFG->params->id=0+trim($_REQUEST['id']);

uxmHeader('������ ����������')
?>
<H1>������ ����������</H1>
<? if('POST'==$_SERVER['REQUEST_METHOD']): 
system("/usr/bin/net rpc file close {$CFG->params->id} -S dbServ -U ".$_SERVER['PHP_AUTH_USER']."%".$_SERVER['PHP_AUTH_PW'], $A);
?>
<Script><!--
window.close();
//--></Script>
<H2>���������� ���������</H2>
<? else: ?>
<Center>
<Form Action='./' Method='POST'>
�� �������, ��� ������ ��������� ��� ���������?
<P />
<Input Type='Submit' Value=' �� ' />
<Input Type='Button' Value=' ��� ' onClick='window.close()' />
<?
HiddenInputs();
?>
</Form>
</Center>
<Small>
����� ���������� � ����� ���������� ������ ����� ��������� � ���������������
� ���������� ������������. ��������� ��� ���� ������� ������ ��� �������������,
� ������ ���� �� ����� ������, ��� �������.
</Small>
<? endif; ?>
</body>
</html>
