<?
switch($_SESSION['lib'])
{
 case 'hard':
  $_SESSION['type']='random';
  $_SESSION['n']=15;
  $_SESSION['chars']='a';
  $_SESSION['case']='mix';
  $_SESSION['spec']=true;
  break;
 case 'w2':
  $_SESSION['type']='word';
  $_SESSION['n']='2';
  $_SESSION['case']='lo';
  $_SESSION['lang']='ru';
  $_SESSION['cyr']='kbd';
  break;
 default:
  $_SESSION['type']='random';
  $_SESSION['n']=8;
  $_SESSION['chars']='d';
  $_SESSION['spec']=false;
}
?>
