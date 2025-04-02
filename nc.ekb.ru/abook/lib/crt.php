<?
global $CFG;

if(!function_exists('mssql_pconnect')) dl('mssql.so');
$CFG->Directum->h=@mssql_pconnect('directum', "LAN\\".$CFG->u, $_SERVER['PHP_AUTH_PW']);

$x=mssql_query("Select u, TekstT2 As Crt From Reports..jCertificates Where u='".strtr($CFG->params->u, "'", "''")."'", $CFG->Directum->h);
$x=mssql_fetch_object($x);
if(!$x):
  Header('HTTP/1.0 404');
  uxmHeader('Нет сертификата');
  echo "<H1 Class='Error'>Нет сертификата</H1>";
  exit;
endif;
//print_r($x);
#Header('Content-Type: application/x-x509-ca-cert');
$e=getEntry($CFG->udn, 'cn');
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: inline; filename="'.$CFG->params->u.'.cer"');
Header('X-CN: '.transLit(utf2str($e['cn'][0])));
echo $x->Crt;

?>
