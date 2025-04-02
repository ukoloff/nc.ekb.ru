<?
global $CFG;

switch($_SESSION['chars'])
{
 case 'a':
 case 'w': $CFG->Wizard->nextPage='case'; 
}

?>
