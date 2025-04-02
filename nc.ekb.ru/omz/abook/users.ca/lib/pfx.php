<?
LoadLib('/pfx');

if('old'==$_GET[key]):
 $R=pfxCall('oldpfx', $CFG->params->n);
 Header('Content-Type: application/octet-stream');
 Header('Content-Disposition: attachment; filename="'.$R[0].'"');
 echo base64_decode($R[1]);
// echo "<Script>window.close();</Script>";
 exit;
endif;

$R=pfxCall('getpfx', $CFG->params->n.' '.$_GET[key]);

Header('Content-Type: application/octet-stream');
Header('Content-Disposition: attachment; filename="'.$R[0].'.pfx"');
echo base64_decode($R[1]);
?>
