<?php

function transliterate($st) {
                               
  $st = strtr($st, 

    "абвгдезиклмнопрстуфыАБВГДЕЗИКЛМНОПРСТУФЫ",

    "abvgdeziklmnoprstufyABVGDEZIKLMNOPRSTUFY"

  );

  $st = strtr($st, array(

    'й'=>"y",    'э'=>"e",  'Й'=>"Y",  'Э'=>"E",  'ж'=>"zh", 'Ж'=>"Zh",

    'ё'=>"yo",    'х'=>"kh",  'ц'=>"ts",  'ч'=>"ch", 'ш'=>"sh",  

    'щ'=>"shch",  'ъ'=>'',   'ь'=>'',    'ю'=>"yu", 'я'=>"ya",

    'Ё'=>"Yo",    'Х'=>"Kh",  'Ц'=>"Ts",  'Ч'=>"Ch", 'Ш'=>"Sh",

    'Щ'=>"Shch",  'Ъ'=>'',   'Ь'=>'',    'Ю'=>"Yu", 'Я'=>"Ya",

  ));

  return $st;

}
?>