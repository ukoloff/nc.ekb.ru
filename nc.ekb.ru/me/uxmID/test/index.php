<?
require('../../../lib/uxm.php');

$CFG->authURL='https://ekb.ru/me/uxmID/';

session_name('uxmIDtest');
session_start();

LoadLib('POST'==$_SERVER['REQUEST_METHOD']? 'post' : 'get');

uxmHeader('�������� uxmID');
?>
<H1>�������� uxmID</H1>

<Script><!--
if(!Statistics.cookies)
  document.writeln("<H3 Class='Error'>�������� ����������� ������� ���������� Cookies!</H3>");
//--></Script>

<Form Action='./' Method='POST'>

<Input Type='Submit' Value=' ��������������! ' />

</Form>

<?
if($_SESSION['res']):
 echo "<PRE>\n";
 print_r($_SESSION['res']);
 echo "</PRE>\n";
endif;

if($CFG->dropSession) session_destroy();
?>
</body></html>
