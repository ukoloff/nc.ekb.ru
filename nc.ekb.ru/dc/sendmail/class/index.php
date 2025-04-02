<?
require('../../../lib/uxm.php');

LoadLib('/forms');
$CFG->params->x=$_REQUEST['x'];
$CFG->isNew='new'==$CFG->params->x;

$f="lib/".strtolower($_SERVER['REQUEST_METHOD']).".php";
if(!file_exists($f)):
 Header('HTTP/1.0 400 Bad request');
 exit;
endif;
require($f);

uxmHeader('Почтовый класс');
$CFG->defaults->Input->H=10;
?>
<H1>Почтовый класс</H1>
<?
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
<Form Method='POST' Action='./'>
<Table><TR vAlign='_top'><TD>
<?
Input('c', 'Класс');
?>
</TD><TD>
<?
Input('description', 'Описание');
?>
</TD></TR>
<TR vAlign='_top'><TD>
<?
TextArea('items', 'Состав');
?>
</TD><TD>
<?
TextArea('info', 'Заметки');
?>
</TD></TR></Table>
<?
HiddenInputs();
Submit();
HR();
?>
</Form>
&raquo;
<A hRef='../classes/'>Все классы</A>
<BR />
&raquo;
Изменения классов вступают в силу только после перезапуска sendmail
</body></html>
