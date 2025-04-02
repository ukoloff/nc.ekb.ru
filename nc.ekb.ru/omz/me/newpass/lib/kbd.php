<? // Преобразование русских букв в английские как на клавиатуре
setlocale(LC_ALL, "ru_RU.cp1251");

global $CFG;

function Generate()
{
 global $CFG;
 $ru="йцукенгшщзхъ#фывапролджэ#ячсмитьбюё";
 $en="qwertyuiop[]#asdfghjkl;'#zxcvbnm,.`";
 $ru2="хъжэбюё";
 $en2='{}:"<>~';
 $r=''; $e='';
 for($i=0; $c=$ru{$i}; $i++):
  if('#'!=$c):
   $r.=strtoupper($c);
   $cc=strtr($c, $ru2, $en2);
   $e.=($cc==$c)?strtoupper(strtr($c, $ru, $en)):$cc;
  endif;
  $r.=$c;
  $e.=strtr($c, $ru, $en);
 endfor;
 $CFG->ru=$r;
 $CFG->en=$e;
}

Generate();

function word2en($w)
{
 global $CFG;
 return strtr($w, $CFG->ru, $CFG->en)." ".$w;
}

?>
