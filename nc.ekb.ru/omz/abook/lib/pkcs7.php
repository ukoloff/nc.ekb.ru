<?
Header('Content-Type: application/octet-stream');
Header('Content-Disposition: inline; filename="'.$CFG->params->u.'.p7b"');

LoadLib('/pfx');
echo join("\n", pfxCall('pkcs7', $CFG->params->u, 1));

?>
