<?
include_once('/etc/nc.ekb.ru/passwd/sd-old.ekb.ru');

$CFG->ocs = new PDO("mysql:host=$ocsHost;dbname=$ocsDB", $ocsUser, $ocsPass);
$CFG->ocs->exec('Set Names cp1251');