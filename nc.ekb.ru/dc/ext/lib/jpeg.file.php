<?
function getJPG($N)
{
  return file_get_contents($_SERVER['DOCUMENT_ROOT']."/img/photo/$N.jpg"); 
}
?>
