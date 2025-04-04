<?php

/**
 * PostgreSQL 8.1 support
 *
 * $Id: Postgres81.php,v 1.12 2006/12/28 04:26:55 xzilla Exp $
 */

include_once('./classes/database/Postgres80.php');

class Postgres81 extends Postgres80 {

	var $major_version = 8.1;

	// Map of database encoding names to HTTP encoding names.  If a
	// database encoding does not appear in this list, then its HTTP
	// encoding name is the same as its database encoding name.
	var $codemap = array(
		'BIG5' => 'BIG5',
		'EUC_CN' => 'GB2312',
		'EUC_JP' => 'EUC-JP',
		'EUC_KR' => 'EUC-KR',
		'EUC_TW' => 'EUC-TW', 
		'GB18030' => 'GB18030',
		'GBK' => 'GB2312',
		'ISO_8859_5' => 'ISO-8859-5',
		'ISO_8859_6' => 'ISO-8859-6',
		'ISO_8859_7' => 'ISO-8859-7',
		'ISO_8859_8' => 'ISO-8859-8',
		'JOHAB' => 'CP1361',
		'KOI8' => 'KOI8-R',
		'LATIN1' => 'ISO-8859-1',
		'LATIN2' => 'ISO-8859-2',
		'LATIN3' => 'ISO-8859-3',
		'LATIN4' => 'ISO-8859-4',
		'LATIN5' => 'ISO-8859-9',
		'LATIN6' => 'ISO-8859-10',
		'LATIN7' => 'ISO-8859-13',
		'LATIN8' => 'ISO-8859-14',
		'LATIN9' => 'ISO-8859-15',
		'LATIN10' => 'ISO-8859-16',
		'SJIS' => 'SHIFT_JIS',
		'SQL_ASCII' => 'US-ASCII',
		'UHC' => 'WIN949',
		'UTF8' => 'UTF-8',
		'WIN866' => 'CP866',
		'WIN874' => 'CP874',
		'WIN1250' => 'CP1250',
		'WIN1251' => 'CP1251',
		'WIN1252' => 'CP1252',
		'WIN1256' => 'CP1256',
		'WIN1258' => 'CP1258'
	);
	
	// Last oid assigned to a system object
	var $_lastSystemOID = 17231;

	/**
	 * Constructor
	 * @param $conn The database connection
	 */
	function Postgres81($conn) {
		$this->Postgres80($conn);
	}

	// Help functions
	
	function getHelpPages() {
		include_once('./help/PostgresDoc81.php');
		return $this->help_page;
	}

	// Database Functions
	/**
	 * Return all database available on the server
	 * @return A list of databases, sorted alphabetically
	 */
	function getDatabases($currentdatabase = NULL) {
		global $conf, $misc;
		
		$server_info = $misc->getServerInfo();
		
		if (isset($conf['owned_only']) && $conf['owned_only'] && !$this->isSuperUser($server_info['username'])) {
			$username = $server_info['username'];
			$this->clean($username);
			$clause = " AND pu.usename='{$username}'";
		}
		else $clause = '';

		if ($currentdatabase != NULL)
			$orderby = "ORDER BY pdb.datname = '{$currentdatabase}' DESC, pdb.datname";
		else
			$orderby = "ORDER BY pdb.datname";

		if (!$conf['show_system'])
			$where = ' AND NOT pdb.datistemplate';
		else
			$where = ' AND pdb.datallowconn';

		$sql = "SELECT pdb.datname AS datname, pr.rolname AS datowner, pg_encoding_to_char(encoding) AS datencoding,
                               (SELECT description FROM pg_catalog.pg_description pd WHERE pdb.oid=pd.objoid) AS datcomment,
                               (SELECT spcname FROM pg_catalog.pg_tablespace pt WHERE pt.oid=pdb.dattablespace) AS tablespace,
							   pg_catalog.pg_database_size(pdb.oid) as dbsize 
                        FROM pg_catalog.pg_database pdb LEFT JOIN pg_catalog.pg_roles pr ON (pdb.datdba = pr.oid)  
						WHERE true 
			{$where}
			{$clause}
			{$orderby}";

		return $this->selectSet($sql);
	}

	/**
	 * Returns prepared transactions information
	 * @param $database (optional) Find only prepared trasactions executed in a specific database
	 * @return A recordset
	 */
	function getPreparedXacts($database = null) {
		if ($database === null)
			$sql = "SELECT * FROM pg_prepared_xacts";
		else {
			$this->clean($database);
			$sql = "SELECT transaction, gid, prepared, owner FROM pg_prepared_xacts WHERE database='{$database}' 
				   ORDER BY owner";
		}
		
		return $this->selectSet($sql);
	}

	// Roles
		
	/**
	 * Returns all roles in the database cluster
	 * @param $rolename (optional) The roleme to exclude from the select
	 * @return All roles
	 */
	function getRoles($rolename = '') {
		$sql = 'SELECT rolname, rolsuper, rolcreatedb, rolcreaterole, rolinherit, rolcanlogin, rolconnlimit, rolvaliduntil, 
			rolconfig FROM pg_catalog.pg_roles';
		if($rolename) $sql .= " WHERE rolname!='{$rolename}'";
		$sql .= ' ORDER BY rolname';

		return $this->selectSet($sql);
	}
	
	/**
	 * Returns information about a single role
	 * @param $rolename The rolename of the role to retrieve
	 * @return The role's data
	 */
	function getRole($rolename) {
		$this->clean($rolename);
		
		$sql = "SELECT rolname, rolsuper, rolcreatedb, rolcreaterole, rolinherit, rolcanlogin, rolconnlimit, rolvaliduntil, 
			rolconfig FROM pg_catalog.pg_roles WHERE rolname='{$rolename}'";

		return $this->selectSet($sql);
	}

	/**
	 * Creates a new role
	 * @param $rolename The rolename of the role to create
	 * @param $password A password for the role
	 * @param $superuser Boolean whether or not the role is a superuser
	 * @param $createdb Boolean whether or not the role can create databases
	 * @param $createrole Boolean whether or not the role can create other roles
	 * @param $inherits Boolean whether or not the role inherits the privileges from parent roles
	 * @param $login Boolean whether or not the role will be allowed to login
	 * @param $connlimit Number of concurrent connections the role can make
	 * @param $expiry String Format 'YYYY-MM-DD HH:MM:SS'.  '' means never expire
	 * @param $memberof (array) Roles to which the new role will be immediately added as a new member
	 * @param $members (array) Roles which are automatically added as members of the new role
	 * @param $adminmembers (array) Roles which are automatically added as admin members of the new role
	 * @return 0 success
	 */
	function createRole($rolename, $password, $superuser, $createdb, $createrole, $inherits, $login, $connlimit, $expiry, $memberof, $members, $adminmembers) {
		$enc = $this->_encryptPassword($rolename, $password);
		$this->fieldClean($rolename);
		$this->clean($enc);
		$this->clean($connlimit);
		$this->clean($expiry);
		$this->fieldArrayClean($memberof);
		$this->fieldArrayClean($members);
		$this->fieldArrayClean($adminmembers);

		$sql = "CREATE ROLE \"{$rolename}\"";
		if ($password != '') $sql .= " WITH ENCRYPTED PASSWORD '{$enc}'";
		$sql .= ($superuser) ? ' SUPERUSER' : ' NOSUPERUSER';
		$sql .= ($createdb) ? ' CREATEDB' : ' NOCREATEDB';
		$sql .= ($createrole) ? ' CREATEROLE' : ' NOCREATEROLE';
		$sql .= ($inherits) ? ' INHERIT' : ' NOINHERIT';
		$sql .= ($login) ? ' LOGIN' : ' NOLOGIN';
		if ($connlimit != '') $sql .= " CONNECTION LIMIT {$connlimit}"; else  $sql .= ' CONNECTION LIMIT -1';
		if ($expiry != '') $sql .= " VALID UNTIL '{$expiry}'"; else $sql .= " VALID UNTIL 'infinity'";
		if (is_array($memberof) && sizeof($memberof) > 0) $sql .= ' IN ROLE "' . join('", "', $memberof) . '"';
		if (is_array($members) && sizeof($members) > 0) $sql .= ' ROLE "' . join('", "', $members) . '"';
		if (is_array($adminmembers) && sizeof($adminmembers) > 0) $sql .= ' ADMIN "' . join('", "', $adminmembers) . '"';

		return $this->execute($sql);
	}	
	
	/**
	 * Removes a role
	 * @param $rolename The rolename of the role to drop
	 * @return 0 success
	 */
	function dropRole($rolename) {
		$this->fieldClean($rolename);

		$sql = "DROP ROLE \"{$rolename}\"";
		
		return $this->execute($sql);
	}

	/**
	 * Adjusts a role's info and renames it
	 * @param $rolename The rolename of the role to create
	 * @param $password A password for the role
	 * @param $superuser Boolean whether or not the role is a superuser
	 * @param $createdb Boolean whether or not the role can create databases
	 * @param $createrole Boolean whether or not the role can create other roles
	 * @param $inherits Boolean whether or not the role inherits the privileges from parent roles
	 * @param $login Boolean whether or not the role will be allowed to login
	 * @param $connlimit Number of concurrent connections the role can make
	 * @param $expiry string Format 'YYYY-MM-DD HH:MM:SS'.  '' means never expire
	 * @param $memberof (array) Roles to which the role will be immediately added as a new member
	 * @param $members (array) Roles which are automatically added as members of the role
	 * @param $adminmembers (array) Roles which are automatically added as admin members of the role
	 * @param $memberofold (array) Original roles whose the role belongs to
	 * @param $membersold (array) Original roles that are members of the role
	 * @param $adminmembersold (array) Original roles that are admin members of the role
	 * @param $newrolename The new name of the role
	 * @return 0 success
	 * @return -1 transaction error
	 * @return -2 set role attributes error
	 * @return -3 rename error
	 */
	function setRenameRole($rolename, $password, $superuser, $createdb, $createrole, $inherits, $login, $connlimit, $expiry, $memberof, $members, $adminmembers, $memberofold, $membersold, $adminmembersold, $newrolename) {
			
		$status = $this->beginTransaction();
		if ($status != 0) return -1;

		$status = $this->setRole($rolename, $password, $superuser, $createdb, $createrole, $inherits, $login, $connlimit, $expiry, $memberof, $members, $adminmembers, $memberofold, $membersold, $adminmembersold);
		if ($status != 0) {
			$this->rollbackTransaction();
			return -2;
		}

		if ($rolename != $newrolename){
			$status = $this->renameRole($rolename, $newrolename);
			if ($status != 0) {
				$this->rollbackTransaction();
				return -3;
			}
		}

		return $this->endTransaction();
	}

	/**
	 * Adjusts a role's info
	 * @param $rolename The rolename of the role to create
	 * @param $password A password for the role
	 * @param $superuser Boolean whether or not the role is a superuser
	 * @param $createdb Boolean whether or not the role can create databases
	 * @param $createrole Boolean whether or not the role can create other roles
	 * @param $inherits Boolean whether or not the role inherits the privileges from parent roles
	 * @param $login Boolean whether or not the role will be allowed to login
	 * @param $connlimit Number of concurrent connections the role can make
	 * @param $expiry string Format 'YYYY-MM-DD HH:MM:SS'.  '' means never expire
	 * @param $memberof (array) Roles to which the role will be immediately added as a new member
	 * @param $members (array) Roles which are automatically added as members of the role
	 * @param $adminmembers (array) Roles which are automatically added as admin members of the role
	 * @param $memberofold (array) Original roles whose the role belongs to
	 * @param $membersold (array) Original roles that are members of the role
	 * @param $adminmembersold (array) Original roles that are admin members of the role
	 * @return 0 success
	 */
	function setRole($rolename, $password, $superuser, $createdb, $createrole, $inherits, $login, $connlimit, $expiry, $memberof, $members, $adminmembers, $memberofold, $membersold, $adminmembersold) {
		$enc = $this->_encryptPassword($rolename, $password);
		$this->fieldClean($rolename);
		$this->clean($enc);
		$this->clean($connlimit);
		$this->clean($expiry);
		$this->fieldArrayClean($memberof);
		$this->fieldArrayClean($members);
		$this->fieldArrayClean($adminmembers);

		$sql = "ALTER ROLE \"{$rolename}\"";
		if ($password != '') $sql .= " WITH ENCRYPTED PASSWORD '{$enc}'";
		$sql .= ($superuser) ? ' SUPERUSER' : ' NOSUPERUSER';
		$sql .= ($createdb) ? ' CREATEDB' : ' NOCREATEDB';
		$sql .= ($createrole) ? ' CREATEROLE' : ' NOCREATEROLE';
		$sql .= ($inherits) ? ' INHERIT' : ' NOINHERIT';
		$sql .= ($login) ? ' LOGIN' : ' NOLOGIN';
		if ($connlimit != '') $sql .= " CONNECTION LIMIT {$connlimit}"; else $sql .= ' CONNECTION LIMIT -1';
		if ($expiry != '') $sql .= " VALID UNTIL '{$expiry}'"; else $sql .= " VALID UNTIL 'infinity'";
		
		$status = $this->execute($sql);
		
		if ($status != 0) return -1;

		//memberof
		$old = explode(',', $memberofold);
		foreach ($memberof as $m) {
			if (!in_array($m, $old)) {
				$status = $this->grantRole($m, $rolename);
				if ($status != 0) return -1;
			}	
		}
		if($memberofold)
		{
			foreach ($old as $o) {
				if (!in_array($o, $memberof)) {
					$status = $this->revokeRole($o, $rolename, 0, 'CASCADE');
					if ($status != 0) return -1;
				}
			}
		}

		//members
		$old = explode(',', $membersold);
		foreach ($members as $m) {
			if (!in_array($m, $old)) {
				$status = $this->grantRole($rolename, $m);
				if ($status != 0) return -1;
			}	
		}
		if($membersold)
		{
			foreach ($old as $o) {
				if (!in_array($o, $members)) {
					$status = $this->revokeRole($rolename, $o, 0, 'CASCADE');
					if ($status != 0) return -1;
				}
			}
		}

		//adminmembers
		$old = explode(',', $adminmembersold);
		foreach ($adminmembers as $m) {
			if (!in_array($m, $old)) {
				$status = $this->grantRole($rolename, $m, 1);
				if ($status != 0) return -1;
			}	
		}
		if($adminmembersold)
		{
			foreach ($old as $o) {
				if (!in_array($o, $adminmembers)) {
					$status = $this->revokeRole($rolename, $o, 1, 'CASCADE');
					if ($status != 0) return -1;
				}
			}
		}

		return $status;
	}	

	/**
	 * Renames a role
	 * @param $rolename The rolename of the role to rename
	 * @param $newrolename The new name of the role
	 * @return 0 success
	 */
	function renameRole($rolename, $newrolename){
		$this->fieldClean($rolename);
		$this->fieldClean($newrolename);

		$sql = "ALTER ROLE \"{$rolename}\" RENAME TO \"{$newrolename}\"";

		return $this->execute($sql);
	}

	/**
	 * Grants membership in a role
	 * @param $role The name of the target role
	 * @param $rolename The name of the role that will belong to the target role
	 * @param $admin (optional) Flag to grant the admin option
	 * @return 0 success
	 */
	function grantRole($role, $rolename, $admin=0) {
		$this->fieldClean($role);
		$this->fieldClean($rolename);

		$sql = "GRANT \"{$role}\" TO \"{$rolename}\"";
		if($admin == 1) $sql .= ' WITH ADMIN OPTION';
	
		return $this->execute($sql);
	}
	
	/**
	 * Revokes membership in a role
	 * @param $role The name of the target role
	 * @param $rolename The name of the role that will not belong to the target role
	 * @param $admin (optional) Flag to revoke only the admin option
	 * @param $type (optional) Type of revoke: RESTRICT | CASCADE
	 * @return 0 success
	 */
	function revokeRole($role, $rolename, $admin = 0, $type = 'RESTRICT') {
		$this->fieldClean($role);
		$this->fieldClean($rolename);

		$sql = "REVOKE ";
		if($admin == 1) $sql .= 'ADMIN OPTION FOR ';
		$sql .= "\"{$role}\" FROM \"{$rolename}\" {$type}";

		return $this->execute($sql);
	}

	/**
	 * Changes a role's password
	 * @param $rolename The rolename
	 * @param $password The new password
	 * @return 0 success
	 */
	function changePassword($rolename, $password) {
		$enc = $this->_encryptPassword($rolename, $password);
		$this->fieldClean($rolename);
		$this->clean($enc);
		
		$sql = "ALTER ROLE \"{$rolename}\" WITH ENCRYPTED PASSWORD '{$enc}'";
		
		return $this->execute($sql);
	}

	/**
	* Returns all rolenames which the role belongs to
	* @param $rolename The rolename
	* @return All rolenames
	*/
	function getMemberOf($rolename) {
		$this->clean($rolname);

		$sql = "SELECT rolname FROM pg_catalog.pg_roles R, pg_auth_members M WHERE R.oid=M.roleid 
			AND member IN (SELECT oid FROM pg_catalog.pg_roles WHERE rolname='{$rolename}') ORDER BY rolname";

		return $this->selectSet($sql);
	}

	/**
	* Returns all rolenames that are members of a role
	* @param $rolename The rolename
	* @param $admin (optional) Find only admin members
	* @return All rolenames
	*/
	function getMembers($rolename, $admin = 'f') {
		$this->clean($rolname);

		$sql = "SELECT rolname FROM pg_catalog.pg_roles R, pg_auth_members M WHERE R.oid=M.member AND admin_option='{$admin}' 
			AND roleid IN (SELECT oid FROM pg_catalog.pg_roles WHERE rolname='{$rolename}') ORDER BY rolname";

		return $this->selectSet($sql);
	}

	/**
	 * Returns all available process information.
	 * @return A recordset
	 */
	function getAutovacuum() {
		$sql = "SELECT vacrelid, nspname, relname, enabled, vac_base_thresh, vac_scale_factor, anl_base_thresh, anl_scale_factor, vac_cost_delay, vac_cost_limit 
					FROM pg_autovacuum join pg_class on (oid=vacrelid) join pg_namespace on (oid=relnamespace) ORDER BY nspname, relname";
		
		return $this->selectSet($sql);
	}
	
	/**
	 * Enables a trigger
	 * @param $tgname The name of the trigger to enable
	 * @param $table The table in which to enable the trigger
	 * @return 0 success
	 */
	function enableTrigger($tgname, $table) {
		$this->fieldClean($tgname);
		$this->fieldClean($table);

		$sql = "ALTER TABLE \"{$table}\" ENABLE TRIGGER \"{$tgname}\"";

		return $this->execute($sql);
	}

	/**
	 * Disables a trigger
	 * @param $tgname The name of the trigger to disable
	 * @param $table The table in which to disable the trigger
	 * @return 0 success
	 */
	function disableTrigger($tgname, $table) {
		$this->fieldClean($tgname);
		$this->fieldClean($table);

		$sql = "ALTER TABLE \"{$table}\" DISABLE TRIGGER \"{$tgname}\"";

		return $this->execute($sql);
	}

	
	// Capabilities
	function hasServerAdminFuncs() { return true; }
	function hasRoles() { return true; }
	function hasAutovacuum() { return true; }
	function hasPreparedXacts() { return true; }
	function hasDisableTriggers() { return true; }
}

?>
