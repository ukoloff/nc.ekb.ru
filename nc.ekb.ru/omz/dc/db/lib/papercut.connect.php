<?
function pgQuery($sql, $values) {
  $c=curl_init('http://nc.ekb.ru/postgresql');
  require('/etc/nc.ekb.ru/passwd/papercut.php');
  $data = Array(
    'connect' => $paperCutLogin,
    'sql' => $sql,
    'values' => $values,
  );
//  echo "[[[", json_encode($data), ']]]';
  curl_setopt($c, CURLOPT_POST, 1);
  curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  // curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
  $Res = curl_exec($c);
  return json_decode($Res);
}
?>
