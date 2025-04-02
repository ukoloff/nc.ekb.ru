<?
if (!preg_match('/^s[.]uk/', $CFG->u)):
  header('Location: ../');
  exit;
endif;
$CFG->title = 'Remote PowerShell';
?>
