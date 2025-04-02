<Style>
details>div:last-child {
  margin-left: 1em;
}
</Style>
<?
dbConnect();

global $D;

$D['/']=Array(N=>'/', name=>'/');

$q=mssql_query(<<<SQL
Select 
    P._Code As X, D._Code As N, D._Description As Name,
    (Select Count(*) From _Reference90 As W Where W._Fld7065RRef=D._IDRRef) As numW
From
    _Reference72 As D 
    Left Join _Reference72 As P On D._ParentIDRRef=P._IDRRef
Order By 1,2
SQL
);
while($r=mssql_fetch_object($q)):
  $r->X=trim($r->X);
  $r->N=trim($r->N);
//  print_r($r);
  if(!$D[$r->X])$r->X='/';
  $D[$r->X]['/'][]=$r->N;
  $D[$r->N]=Array(N=>$r->N, X=>$r->X, name=>$r->Name, numW=>$r->numW);
endwhile;

function deptList($Z, $UL)
{
 global $D;
 if(!count($Z['/']))return;
 if($UL) echo "<Div>\n";
 foreach($Z['/'] as $N):
  $Dept=$D[$N];
  echo "<details><summary><b>", htmlspecialchars($N), "</b>:\n", htmlspecialchars($Dept['name']);
  if($Dept['numW']) echo " [<A hRef='./", hRef('as', 'd', 'q', $N),"'>", $Dept['numW'], " чел</A>]";
  echo "</summary>\n";
  deptList($Dept, 1);
  echo "</details>";
 endforeach;
 if($UL) echo "</Div>\n";
}
//print_r($D);
deptList($D['/'], 0);
?>
