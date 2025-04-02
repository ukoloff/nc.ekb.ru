<?
switch($xyz=$_SESSION['type'])
{
 default: $xyz='word';
 case 'random':
 case 'lib':
}

$CFG->Wizard->nextPage=$xyz;
?>
