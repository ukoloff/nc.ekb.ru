<?
global $CFG;
require("../../lib/uxm.php");

if(!inGroupX('RDP')):
 LoadLib('ban');
 exit;
endif;

$CFG->Fields=Array('s'=>'', 'w'=>'', /*'clp'=>'����� ������',*/ 'drv'=>'�����', 'prn'=>'��������', 'prt'=>'�����', 'crd'=>'�����-�����', 'u'=>'���');
$CFG->defaults->w='0';

function calcH($w)
{
 $w*=3/4;
 return $w==960 ? 1024 : $w;
}

if('POST'==$_SERVER['REQUEST_METHOD']):
 LoadLib('post');
else:
 LoadLib('get');
endif;

LoadLib('body');
?>
</body></html>
