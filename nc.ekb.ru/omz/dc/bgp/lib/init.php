<?
$CFG->title='BGP';

putenv('MIBDIRS=/dev/null');
$CFG->SNMP->host='bgp.ekb.ru';
$CFG->SNMP->community='public';
snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
snmp_set_valueretrieval(SNMP_VALUE_PLAIN);

?>
