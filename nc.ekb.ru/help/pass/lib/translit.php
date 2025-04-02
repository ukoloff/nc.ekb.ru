<? // Преобразование русских букв в английские транслитом
setlocale(LC_ALL, "ru_RU.cp1251");

global $CFG;

function Generate()
{
 global $CFG;
 $ru="абвгдеёжзийклмнопрстуфхцчшщъыьэюя";
 $en="abvgde-jziyklmnoprstufhc---`y'e--";
 $X=Array("ё"=>'yo', 'ч'=>'ch', 'ш'=>'sh', 'щ'=>'sch', 'ю'=>'yu', 'я'=>'ya');
 $Z=Array();
 for($i=0; $c=$ru{$i}; $i++):
  $cc=$X[$c];
  if(!$cc) $cc=$en{$i};
  $Z[strtoupper($c)]=ucfirst($cc); 
  $Z[$c]=$cc;
 endfor;
 $CFG->translit=&$Z;
}

Generate();

function word2en($w)
{
 global $CFG;
 return strtr($w, $CFG->translit);
}

?>
