<?
setlocale(LC_ALL, 'ru_RU.cp1251');
$S='ÀÅ¨Æß';
$S.=strtolower($S);
for($i=0; $i<strlen($S); $i++):
 for($j=0; $j<strlen($S); $j++)
  echo $S{$i}, cmp($S{$i}, $S{$j}), $S{$j}, " ";
 echo "\n";
endfor;


function Cmp($A, $B)
{
 $A=strcoll($A, $B);
 if(0==$A) return '=';
 return $A>0? '>':'<';
}

?>