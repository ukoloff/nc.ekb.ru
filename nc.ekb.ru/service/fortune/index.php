<?
header('Location: /omz/service/fortune/');

require("../../lib/uxm.php");

if('POST'==$_SERVER['REQUEST_METHOD'] and $CFG->Editor)
  LoadLib('post');

if('new'==$_REQUEST['x']):
 $Mode='edit';
 $title='����� �������';
elseif($CFG->params->n=(int)$_REQUEST['n']):
 $Mode='edit';
 $title='�������';
else:
 $Mode='list';
 $title='��������';
endif;

uxmHeader($title);
?>
<H1><?=$title?></H1>
<?
 LoadLib($Mode);
?>
</body></html>
