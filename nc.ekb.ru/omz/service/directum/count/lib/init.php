<?
LoadLib('/dc/user/directum.connect');

$q=mssql_fetch_row(mssql_query(<<<SQL
Select
 Count(*)
From (Select 1 AS Z
    From master..sysprocesses AS SP
    Where program_name='IS-Builder'
    And loginame<>'ISBuilderSystem'
    Group by hostname, loginame, dbid) As X
SQL
, $CFG->Directum->h));

echo $q[0];

exit;
?>
