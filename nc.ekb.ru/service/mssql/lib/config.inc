<?php
/********************************************************************/
/**************     site config                     *****************/
/********************************************************************/


//Server's Host name
$config['userDb']['server'] = 'dbserv.lan.uxm';

//Used to display a default path (ex: to attach or create a DB)
$config['database']['default_path'] = 'C:\\';

dl('mssql.so');
setlocale(LC_ALL, "ru_RU.cp1251");


/********************************************************************/
/**************     end of user configuration       *****************/
/********************************************************************/

  //Gestion des erreurs
  $config['error']['ReportingLevel'] = E_ALL ;                     //Sélection des erreurs affichées
  $config['error']['View'] = true ;    
  
  
  
  
  $config['SQLfunctions'] = Array(
  								'GETDATE',
  );
  $config['type'] = Array(
  							-150 	=> '???',		//SQL-variant
  							-11 	=> '???',		//uniqueidentifier
  							-10 	=> 'text',		//ntext
  							-9 		=> 'text',      //nvarchar
  							-8 		=> 'text',		//nchar
  							-7 		=> 'bit',		//Bit
  							-6 		=> 'number',	//tinyint
  							-5 		=> 'number', 	//Bigint
  							-4 		=> '???',		//Image
  							-3 		=> '???',		//varbinary
  							-2 		=> '???',  		//binary & timestamp
  							-1 		=> 'text',		//text
  							1 		=> 'text',		//char
  							2 		=> 'number',	//numeric
  							3 		=> 'number',	//Decimal & money & smallmoney
  							4		=> 'number',	//Int
  							5 		=> 'number',	//smallint
  							6 		=> 'number',	//Float
  							7 		=> 'number',	//real
  							11 		=> 'date',		//Smalldatetime & datetime
  							12 		=> 'text'		//varchar
  						);
  $config['type_name'] = Array(
  							'varchar' 		=> 12,
  							'datetime' 		=> 11,
  							'smalldatetime' => 11,
  							'real' 			=> 7,
  							'float' 		=> 6,
  							'sql-variant'	=> -150,
  							'uniqueidentifier' => -11,
  							'ntext' 		=> -10,
  							'nvarchar' 		=> -9,
  							'nchar' 		=> -8,
  							'bit' 			=> -7,
  							'tinyint' 		=> -6,
  							'bigint' 		=> -5,
  							'image' 		=> -4,
  							'varbinary' 	=> -3,
  							'binary' 		=> -2,
  							'timestamp' 	=> -2,
  							'text' 			=> -1,
  							'char' 			=> 1,
  							'numeric' 		=> 2,
  							'decimal' 		=> 3,
  							'smallmoney' 	=> 3,
  							'money' 		=> 3,
  							'int' 			=> 4,
  							'smallint' 		=> 5
  						);
  $config['version'] = '0.0.1';
  $config['required'] = Array(
  						'PHP_version' => '4.2.0',
  						'PHP_mssql_extension' => 'mssql',
  						);
  						
  						
?>