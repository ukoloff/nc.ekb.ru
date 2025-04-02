<?php

class Mssql {
	var $host = '';
	var $user = '';
	var $pass = '';	
	var $base = '';
	
	var $connexion;
	
	function Mssql () {
		//Verification si mssql est bien chargé par php, 
		//sinon, on essaye avec dl()
	}
	
	function connect ($host, $user, $pass) {
		if ($connexion = @mssql_connect($host, $user, $pass)) {
			$this->connexion = $connexion;

			$this->host = $host;
			$this->pass = $pass;
			$this->user = $user;
		}
		return $connexion;
	}
	
	function select_db($base) {
		//$base = ($base);
		//echo $base;
		if( @mssql_select_db ( $base, $this->connexion)) {
			$this->base = $base;
		} else {
			$this->msg('SELECT_DB : ' . mssql_get_last_message());
		}
	} 
	
	function close() {
		mssql_close($this->connexion);
	}
	
	function query($query) {
		$result = @mssql_query($query);
		if (!$result) {
			$this->msg('QUERY : ' . mssql_get_last_message() . '<br>' . $query );
		}
		return $result;
	}
	
	function num_rows($result) {
		$num = mssql_num_rows($result);
		return $num;
	}
	
	function fetch_array($result) {
		$row = mssql_fetch_array ($result);
		return $row;
	}
	

	function fetch_field($result) {
		$row = mssql_fetch_field ($result);
		return $row;
	}

	function result($result, $i, $field) {
		$value = mssql_result($result, $i, $field);
		return $value;
	}
	
	function rows_affected() {
		$value = mssql_rows_affected($this->connexion);
		return $value;
	}
	
	function msg ($text) {
      echo '<table border="0" cellspacing="1" cellpadding="2" bgcolor="#DD0000" align="center" width="300">
             <tr class="titre">
              <td><font color="#FFFFFF"><b>Erreur</b></font></td>
             </tr>
             <tr class="contenu">
              <td bgcolor="#FFFFFF">'.$text.'</td>
             </tr>
           </table>';
	}

	function displayQuery($query) {
		echo '<code>'.nl2br($query).'</code><br>';
	}
}
?>