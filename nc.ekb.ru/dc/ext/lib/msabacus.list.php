<?
global $CFG;

 LoadLib('/sort');
 $CFG->sort=Array(
    'n'=>Array('field'=>'Nam', 'name'=>'Имя'),
    't'=>Array('field'=>'TabNo', 'name'=>'№', 'title'=>'Табельный номер'),
    'd'=>Array('field'=>'Dept', 'name'=>'Отдел'),
    'p'=>Array('field'=>'Title', 'name'=>'Должность'),
 );
 $CFG->defaults->sort='nt';

# $Schema=$CFG->Abacus->Schema;
 $Filter=strtr(strtolower($CFG->entry->q), Array("'"=>"''", 'ё'=>'е'));
 switch($CFG->entry->as)
 {
  case "end": $Filter="%$Filter"; break;
  case "sub": $Filter="%$Filter";
  default: $Filter="$Filter%";
  case 'eq':;
 }
# $q=ociParse($CFG->oci, <<<SQL
 $q=mssql_query(<<<SQL
Select N,
 (Select VALUE From OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=7) Nam,
 (Select VALUE From OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=8) TabNo,
 (Select VALUE From OBJ_ATR_STR A, NOM_NOM L
    Where L.ISH_KAT=2004 And L.RES_KAT=2005 AND L.RES_OBJ=N
    And A.N_KAT=2004 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
 ) Dept,
 (Select VALUE From OBJ_ATR_STR A, NOM_NOM L
    Where L.ISH_KAT=184 And L.RES_KAT=2005 AND L.RES_OBJ=N
    And A.N_KAT=184 AND A.N_OBJ=L.ISH_OBJ And A.N_ATR=3
 ) Title
From (Select Distinct(N_OBJ)N From OBJ_ATR_STR Where N_KAT=2005 And VALUE_LOWER Like '$Filter')As Z
Where Not Exists(Select * From OBJ_ATR_STR Where N_KAT=2005 And N_OBJ=N And N_ATR=16)
SQL
.sqlOrderBy(), $CFG->sql);
 
$CFG->params->as=$CFG->entry->as;
 sortedHeader('ntdp');
# ociBindByName($q, "Filter", $Filter);
# ociExecute($q);
 unset($CFG->params->q);
 unset($CFG->params->as);
 unset($CFG->params->sort);
 while($r=mssql_fetch_row($q)):
  echo "<TR>";
  $n=$r[0];
  echo "<TD><A hRef='./", htmlspecialchars(hRef('i', $r[0])), "'>", htmlspecialchars($r[1]), "</A><BR /></TD>";
  for($i=2; $i<=4; $i++)
   echo "<TD>", htmlspecialchars($r[$i]), "<BR /></TD>";
  echo "</TR>\n";
 endwhile;
# ociFreeStatement($q);
# mssql_free_result($q);
 sortedFooter();
?>