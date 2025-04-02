<?
global $CFG;

$CFG->extra=Array(
    '#'=>Array('name'=>'Внешние пользователи выделенной линии'),   
    '$'=>Array('name'=>'Внешние пользователи dialup'),   
    '<'=>Array('name'=>'Входящий трафик Экском', 'display'=>1),   
    '<UTK'=>Array('name'=>'Входящий трафик УТК', 'display'=>1), 
    '>'=>Array('name'=>'Исходящий трафик Экском'),   
    '>UTK'=>Array('name'=>'Исходящий трафик УТК'), 
    '?'=>Array('name'=>'Сбои статистики'),   
);

function extra2obj($u)
{
 global $CFG;
 if(!($x=$CFG->extra[$u])) return;
 $z->name=$x['name'];
 $z->display=$x['display'];
 return $z;
}


?>
