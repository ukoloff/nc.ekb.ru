<?php

function transliterate($st) {
                               
  $st = strtr($st, 

    "����������������������������������������",

    "abvgdeziklmnoprstufyABVGDEZIKLMNOPRSTUFY"

  );

  $st = strtr($st, array(

    '�'=>"y",    '�'=>"e",  '�'=>"Y",  '�'=>"E",  '�'=>"zh", '�'=>"Zh",

    '�'=>"yo",    '�'=>"kh",  '�'=>"ts",  '�'=>"ch", '�'=>"sh",  

    '�'=>"shch",  '�'=>'',   '�'=>'',    '�'=>"yu", '�'=>"ya",

    '�'=>"Yo",    '�'=>"Kh",  '�'=>"Ts",  '�'=>"Ch", '�'=>"Sh",

    '�'=>"Shch",  '�'=>'',   '�'=>'',    '�'=>"Yu", '�'=>"Ya",

  ));

  return $st;

}
?>