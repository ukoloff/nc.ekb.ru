<?
global $CFG;

$Schema=$CFG->Abacus->Schema;

$q=ociParse($CFG->oci, <<<SQL
Select VALUE From $Schema.OBJ_ATR_STR A, $Schema.NOM_NOM L
    Where L.ISH_KAT=2004 And L.RES_KAT=2005 AND L.RES_OBJ=:N
    And A.N_KAT=2004 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
SQL
);
ociBindByName($q, "N", $CFG->i);
ociExecute($q);
if(ociFetchInto($q, $r))
  $CFG->Attrs[]=Array('Name'=>'Отдел', 'Value'=>$r[0]);


$q=ociParse($CFG->oci, <<<SQL
Select VALUE From $Schema.OBJ_ATR_STR A, $Schema.NOM_NOM L
    Where L.ISH_KAT=184 And L.RES_KAT=2005 AND L.RES_OBJ=:N
    And A.N_KAT=184 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
SQL
);
ociBindByName($q, "N", $CFG->i);
ociExecute($q);
if(ociFetchInto($q, $r))
  $CFG->Attrs[]=Array('Name'=>'Должность', 'Value'=>$r[0], 'Field'=>'title');

$q=ociParse($CFG->oci, <<<SQL
Select N_ATR, VALUE,
 (Select Name From {$CFG->Abacus->metaSchema}.ATRIB Where N_ATR=OB.N_ATR) OName
From $Schema.OBJ_ATR_STR OB
Where N_KAT=2005 And N_OBJ=:N
SQL
);
 
ociBindByName($q, "N", $CFG->i);
ociExecute($q);

$Links=Array(
    3=>'displayName',
    7=>'cn',
    8=>'employeeID',
    90=>'givenName',
    91=>'sn',
    92=>'middleName',
);

while(ociFetchInto($q, $r))
  $CFG->Attrs[]=Array('Name'=>$r[2]?$r[2]:"#".$r[0], 'Value'=>$r[1], 'Field'=>$Links[$r[0]]);


?>
