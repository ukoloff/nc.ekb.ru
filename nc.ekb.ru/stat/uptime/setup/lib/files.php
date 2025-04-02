<?
global $CFG;

if('new'==trim($_REQUEST['x'])):
  LoadLib('files.new');
endif;

LoadLib('/sort');
$CFG->sort=Array(
    'n'=>Array('field'=>'n', 'name'=>'Файл'),
    's'=>Array('field'=>'size', 'name'=>'Размер'),
    't'=>Array('field'=>'t', 'name'=>'Изменён'),
);
$CFG->defaults->sort='nt';

uxmHeader('Доступные файлы');
?>
<H1>Доступные файлы</H1>
<?
$Files=Array();
foreach(glob($CFG->sqlPath.'*.sq3') as $f):
 unset($X);
 $X->n=basename($f, '.sq3');
 $X->size=filesize($f);
 $X->t=filemtime($f);
 $Files[]=$X;
// echo '<LI><A hRef="./', hRef('f', $bf), '">', $bf, "</A>\n";
endforeach;

sortArray($Files);

sortedHeader('nst');

foreach($Files as $X):
 echo '<TR><TD><A hRef="', hRef('f', $X->n), '">', $X->n, 
	"</A></TD><TD Align='right'>", $X->size, 
	"</TD><TD Align='right'>", strftime("%x %X", $X->t), "</TD></TR>\n";
endforeach;

sortedFooter();

?>
&raquo;
<A hRef="./<?=htmlspecialchars(hRef('x', 'new'))?>">Создать новый файл</A>
