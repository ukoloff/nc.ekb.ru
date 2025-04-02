<?
//doDebug();
//$q = mysql_connect('nc.ekb.ru', 'ro', 'C6J35CQAkSXS5QrX');

try {
  require_once('/etc/nc.ekb.ru/passwd/sigur.php');
  $CFG->sigur = new PDO("mysql:dbname=$sigurDB;host=$sigurHost;port=$sigurPort", $sugurUser, $sigurPass);
  $CFG->sigur->exec("Set Names cp1251");
}
catch(PDOException $Ex) {
  echo "<H2 Class='Error'>Проблема соединения с БД :-(</H2>";
  exit;
}
?>
