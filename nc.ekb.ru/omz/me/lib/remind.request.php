<?
foreach(explode(' ', 'date time URL Info mail Disable') as $x)
 if(isset($_REQUEST[$x]))
    $CFG->entry->$x=trim($_REQUEST[$x]);

$CFG->entry->mail=(int)!!$CFG->entry->mail;
$CFG->entry->Disable=(int)!!$CFG->entry->Disable;
?>
