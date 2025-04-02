<?
dbConnect();

function dbConnect()
{
 global $CFG;
 if(!function_exists('mssql_pconnect')) dl('mssql.so');
 $CFG->sql=mssql_connect('Q8', 'Video', 'rPU44p8OnCjoWVdHPQZ7FLgTk3waqX9u');
 mssql_select_db('Video');
}

function dbEscape($S)
{
 if(!isset($S)) return 'NULL';
 return "'".strtr($S, Array("'"=>"''"))."'";
}

function dbLastId()
{
 $r=mssql_fetch_row(mssql_query('Select @@IDENTITY'));
 return $r[0];
}

function dbError()
{
 $r=mssql_fetch_row(mssql_query('Select @@ERROR'));
 return $r[0];
}

?>
