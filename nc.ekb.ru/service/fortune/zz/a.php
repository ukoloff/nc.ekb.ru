<?
$S='Qwert �����';
$A=array('������', '������', '������', '������', '������', '������', '������', '������', '������', '������',);
usort($A, strcmp);
echo join(':', $A), "\n";
echo strtoupper($S), "\n";
setlocale(LC_ALL, 'ru_RU.cp1251');
echo strtoupper($S), "\n";
usort($A, strcoll);
echo join(':', $A), "\n";
?>