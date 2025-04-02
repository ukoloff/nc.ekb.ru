<? // Get certificate from Directum
if(!function_exists('mssql_pconnect')) dl('mssql.so');
$CFG->Directum->h=@mssql_pconnect('directum', $CFG->AD->Domain."\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);

$x=mssql_query("Select u, TekstT2 As Crt From Reports..jCertificates Where Login='{$CFG->params->u}'", $CFG->Directum->h);
$x=mssql_fetch_object($x);
if(!$x):
  Header('HTTP/1.0 404');
  exit;
endif;
//print_r($x);
#Header('Content-Type: application/x-x509-ca-cert');
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: inline; filename="'.$CFG->params->u.'.cer"');
echo $x->Crt;
?>
