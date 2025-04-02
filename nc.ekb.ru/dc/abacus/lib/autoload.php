<?
setlocale(LC_ALL, "ru_RU.cp1251");

if(!function_exists('ociplogon')) dl('oci8.so');
#putenv('NLS_LANG=AMERICAN_AMERICA.CL8MSWIN1251');
$CFG->oci=ociPLogon('Linux', 'gjs3Nrk17mvBLyt', 'abacus', 'CL8MSWIN1251');

$CFG->Abacus->Schema='M_DEMO_DATA2';
$CFG->Abacus->metaSchema='M_MD';

?>
