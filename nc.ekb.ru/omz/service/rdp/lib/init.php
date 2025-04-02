<?
if(!inGroupX('RDP')) $CFG->AAA=2;
LoadLib('db');
$CFG->title='Терминальный доступ';

$CFG->Fields=Array('s'=>'', 'w'=>'', /*'clp'=>'Буфер обмена',*/ 'drv'=>'Диски', 'prn'=>'Принтеры', 'prt'=>'Порты', 'crd'=>'Смарт-карты', 'u'=>'Имя');
$CFG->defaults->w='0';

function calcH($w)
{
 $w*=3/4;
 return $w==960 ? 1024 : $w;
}

?>
