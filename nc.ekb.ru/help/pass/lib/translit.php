<? // �������������� ������� ���� � ���������� ����������
setlocale(LC_ALL, "ru_RU.cp1251");

global $CFG;

function Generate()
{
 global $CFG;
 $ru="��������������������������������";
 $en="abvgde-jziyklmnoprstufhc---`y'e--";
 $X=Array("�"=>'yo', '�'=>'ch', '�'=>'sh', '�'=>'sch', '�'=>'yu', '�'=>'ya');
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
