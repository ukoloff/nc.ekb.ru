<?
//ini_set('display_errors', true);
//ini_set('log_errors', false);

require_once(dirname(__FILE__).'/odbtp.connect.php');
//LoadLib('odbtp.connect');

$CFG->odbt=odbtp_connect('dbserv', 'DRIVER=SQL Server;UID=sa;PWD=123456;DATABASE=ORION11;SERVER=SKDSERV\SQLSERVER2005');
odbtp_set_attr(ODB_ATTR_VARDATASIZE, 200000);

if(!$CFG->odbt) echo "<H2 Class='Error'>�������� ���������� � �� :-(</H2>";
?>
