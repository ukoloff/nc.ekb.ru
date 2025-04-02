<?
global $CFG;

#$Schema=$CFG->Abacus->Schema;

$N=0+$CFG->i;
$q=mssql_query(<<<SQL
Select VALUE From OBJ_ATR_STR A, NOM_NOM L
    Where L.ISH_KAT=2004 And L.RES_KAT=2005 AND L.RES_OBJ=$N
    And A.N_KAT=2004 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
SQL
, $CFG->sql);
#ociBindByName($q, "N", $CFG->i);
#ociExecute($q);
if($r=mssql_fetch_row($q))
  $CFG->Attrs[]=Array('Name'=>'Отдел', 'Value'=>$r[0]);


$q=mssql_query(<<<SQL
Select VALUE From OBJ_ATR_STR A, NOM_NOM L
    Where L.ISH_KAT=184 And L.RES_KAT=2005 AND L.RES_OBJ=$N
    And A.N_KAT=184 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
SQL
, $CFG->sql);
#ociBindByName($q, "N", $CFG->i);
#ociExecute($q);
if($r=mssql_fetch_row($q))
  $CFG->Attrs[]=Array('Name'=>'Должность', 'Value'=>$r[0], 'Field'=>'title');

$q=mssql_query(<<<SQL
Select N_ATR, VALUE,
 (Select Name From ATRIB Where N_ATR=OB.N_ATR) OName
From OBJ_ATR_STR OB
Where N_KAT=2005 And N_OBJ=$N
SQL
, $CFG->sql);
 
#$ociBindByName($q, "N", $CFG->i);
#$ociExecute($q);

$Links=Array(
    3=>'displayName',
    7=>'cn',
    8=>'employeeID',
    90=>'givenName',
    91=>'sn',
    92=>'middleName',
);

while($r=mssql_fetch_row($q))
  $CFG->Attrs[]=Array('Name'=>$r[2]?$r[2]:"#".$r[0], 'Value'=>$r[1], 'Field'=>$Links[$r[0]]);


?>
