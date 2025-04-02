<?
global $CFG;

$Defs=Array('host'=>'?', 'name'=>'Новый сервис');

$CFG->oldAttrs=Array();
$CFG->newAttrs=Array();

foreach($CFG->Attrs as $a):
 $aid=$a['id'];
 $v=$_REQUEST[$aid];
 if(!isset($v)) $v=$Defs[$aid];
 if(!isset($v)) continue;
 $CFG->newAttrs[]=Array('No'=>$a['No'], 'Value'=>$v);
endforeach;

unset($Defs);
 $CFG->newAttrs[]=Array();

?>