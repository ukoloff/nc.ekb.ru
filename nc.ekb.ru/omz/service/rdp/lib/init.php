<?
if(!inGroupX('RDP')) $CFG->AAA=2;
LoadLib('db');
$CFG->title='������������ ������';

$CFG->Fields=Array('s'=>'', 'w'=>'', /*'clp'=>'����� ������',*/ 'drv'=>'�����', 'prn'=>'��������', 'prt'=>'�����', 'crd'=>'�����-�����', 'u'=>'���');
$CFG->defaults->w='0';

function calcH($w)
{
 $w*=3/4;
 return $w==960 ? 1024 : $w;
}

?>
