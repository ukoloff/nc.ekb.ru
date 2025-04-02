<?
LoadLib($_GET['i']?'one':'list');

function checkU($u)
{
  return "<A hRef='#' onClick=\"checkU(".jsEscape($u)."); return false;\" title='Открыть пользователя в обоих доменах'>&raquo;</A>";
}
?>
