<? // �������� ����� ����� �� ������� � ����� ������ �����
$CFG->tabs[preg_replace('/\..*/', '', basename(__FILE__))]='���';

foreach(glob(dirname(__FILE__).'/'.preg_replace('/\..*\./', '*', basename(__FILE__))) as $f):
 if(__FILE__==$f) continue;
 $f=preg_replace('/\.[^.]*$/', '', basename($f));
 $CFG->onLoadLib[$f]=function()use($f){LoadLib("/dc/user/$f");};
//$CFG->onLoadLib[$f]=function($x){LoadLib("/dc/user/$x");};
endforeach;
?>
