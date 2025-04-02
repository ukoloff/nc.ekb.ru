<?	// Отдать пользователю его PFX-файл
global $CFG;

ini_set('display_errors', true);
ini_set('log_errors', false);

Header('Content-Type: application/octet-stream');

if(!function_exists('curl_init')) dl('curl.so');

#$AH=apache_request_headers();

//echo "Cookie:=", $AH['Cookie'], "=\n";
//print_r($AH);

$Z=curl_init('https://ekb.ru/me/ticket/get/');

curl_setopt($Z, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($Z, CURLOPT_HEADER, false);
curl_setopt($Z, CURLOPT_RETURNTRANSFER, true);
curl_setopt($Z, CURLOPT_COOKIE, $AH['x-pfx']);

$u=curl_exec($Z);
curl_close($Z);

//echo "=[$u]";
//echo $u;

passthru(dirname(__FILE__).'/pfx.pl 1 | mimencode');

exit;
?>
