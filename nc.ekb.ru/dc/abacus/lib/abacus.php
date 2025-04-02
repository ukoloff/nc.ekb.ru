<?
if(!function_exists('ociplogon')) dl('oci8.so');
#putenv('NLS_LANG=AMERICAN_AMERICA.CL8MSWIN1251');
$CFG->oci=ociPLogon('Linux', 'gjs3Nrk17mvBLyt', 'abacus', 'CL8MSWIN1251');
$CFG->abaSchema='M_DEMO_DATA2';

function Test()
{
 global $CFG;
 $q=ociParse($CFG->oci, "Select Distinct(N_OBJ)
From M_DEMO_DATA2.OBJ_ATR_STR
Where N_KAT=2005 And value_lower Like :Filter");
 $Filter='уко%';
 ociBindByName($q, "Filter", $Filter);
 ociExecute($q);
 while(ociFetchInto($q, $r)):
  print_r($r);
 endwhile;
 ociFreeStatement($q);
}

Test();
?>
