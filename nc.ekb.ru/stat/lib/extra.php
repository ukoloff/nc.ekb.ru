<?
global $CFG;

$CFG->extra=Array(
    '#'=>Array('name'=>'������� ������������ ���������� �����'),   
    '$'=>Array('name'=>'������� ������������ dialup'),   
    '<'=>Array('name'=>'�������� ������ ������', 'display'=>1),   
    '<UTK'=>Array('name'=>'�������� ������ ���', 'display'=>1), 
    '>'=>Array('name'=>'��������� ������ ������'),   
    '>UTK'=>Array('name'=>'��������� ������ ���'), 
    '?'=>Array('name'=>'���� ����������'),   
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
