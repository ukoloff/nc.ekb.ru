<?
if(!function_exists('ociplogon')) dl('oci8.so');
#putenv('NLS_LANG=AMERICAN_AMERICA.CL8MSWIN1251');
$CFG->oci=ociPLogon('Linux', 'gjs3Nrk17mvBLyt', 'abacus', 'CL8MSWIN1251');
$CFG->abaSchema='M_DEMO_DATA2';

function Test()
{
 global $CFG;
 $q=ociParse($CFG->oci, "Select * From {$CFG->abaSchema}.obj_atr_str
  where n_kat=2005
    and n_obj in(22148324, 27950207)");
 ociExecute($q);
 while(ociFetchInto($q, $r)):
  print_r($r);
 endwhile;
 ociFreeStatement($q);
}

Test();
?>
