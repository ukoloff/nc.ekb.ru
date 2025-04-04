<?php

	/**
	 * Manage roles in a database cluster
	 *
	 * $Id: roles.php
	 */

	// Include application functions
	include_once('./libraries/lib.inc.php');

	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];
	
	/**
	 * Displays a screen for create a new role
	 */
	function doCreate($msg = '') {
		global $data, $misc, $username;
		global $PHP_SELF, $lang;
		
		if (!isset($_POST['formRolename'])) $_POST['formRolename'] = '';
		if (!isset($_POST['formPassword'])) $_POST['formPassword'] = '';
		if (!isset($_POST['formConfirm'])) $_POST['formConfirm'] = '';
		if (!isset($_POST['formConnLimit'])) $_POST['formConnLimit'] = '';
		if (!isset($_POST['formExpires'])) $_POST['formExpires'] = '';
		if (!isset($_POST['memberof'])) $_POST['memberof'] = array();
		if (!isset($_POST['members'])) $_POST['members'] = array();
		if (!isset($_POST['adminmembers'])) $_POST['adminmembers'] = array();
	
		$misc->printTrail('role');
		$misc->printTitle($lang['strcreaterole'],'pg.role.create');
		$misc->printMsg($msg);

		echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
		echo $misc->form;
		echo "<table>\n";
		echo "\t<tr>\n\t\t<th class=\"data left required\" width=\"130\">{$lang['strrolename']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" maxlength=\"15\" name=\"formRolename\" value=\"", htmlspecialchars($_POST['formRolename']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strpassword']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" maxlength=\"32\" type=\"password\" name=\"formPassword\" value=\"", htmlspecialchars($_POST['formPassword']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconfirm']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"15\" maxlength=\"32\" type=\"password\" name=\"formConfirm\" value=\"", htmlspecialchars($_POST['formConfirm']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formSuper\">{$lang['strsuper']}</label></th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formSuper\" name=\"formSuper\"", 
			(isset($_POST['formSuper'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCreateDB\">{$lang['strcreatedb']}</label></th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCreateDB\" name=\"formCreateDB\"", 
			(isset($_POST['formCreateDB'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCreateRole\">{$lang['strcancreaterole']}</label></th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCreateDB\" name=\"formCreateRole\"", 
			(isset($_POST['formCreateRole'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCreateDB\">{$lang['strinheritsprivs']}</label></th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formInherits\" name=\"formInherits\"", 
			(isset($_POST['formInherits'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCanLogin\">{$lang['strcanlogin']}</label></th>\n";
		echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCanLogin\" name=\"formCanLogin\"", 
			(isset($_POST['formCanLogin'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";			
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconnlimit']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"4\" name=\"formConnLimit\" value=\"", htmlspecialchars($_POST['formConnLimit']), "\" /></td>\n\t</tr>\n";
		echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strexpires']}</th>\n";
		echo "\t\t<td class=\"data1\"><input size=\"23\" maxlength=\"60\" name=\"formExpires\" value=\"", htmlspecialchars($_POST['formExpires']), "\" /></td>\n\t</tr>\n";
		
		$roles = $data->getRoles();
		if ($roles->recordCount() > 0) {
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strmemberof']}</th>\n";
			echo "\t\t<td class=\"data\">\n";
			echo "\t\t\t<select name=\"memberof[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
			while (!$roles->EOF) {
				$rolename = $roles->f['rolname'];
				echo "\t\t\t\t<option value=\"{$rolename}\"",
				(in_array($rolename, $_POST['memberof']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
				$roles->moveNext();
			}
			echo "\t\t\t</select>\n";
			echo "\t\t</td>\n\t</tr>\n";
			
			$roles->moveFirst();
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strmembers']}</th>\n";
			echo "\t\t<td class=\"data\">\n";
			echo "\t\t\t<select name=\"members[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
			while (!$roles->EOF) {
				$rolename = $roles->f['rolname'];
				echo "\t\t\t\t<option value=\"{$rolename}\"",
				(in_array($rolename, $_POST['members']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
				$roles->moveNext();
			}
			echo "\t\t\t</select>\n";
			echo "\t\t</td>\n\t</tr>\n";

			$roles->moveFirst();
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['stradminmembers']}</th>\n";
			echo "\t\t<td class=\"data\">\n";
			echo "\t\t\t<select name=\"adminmembers[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
			while (!$roles->EOF) {
				$rolename = $roles->f['rolname'];
				echo "\t\t\t\t<option value=\"{$rolename}\"",
				(in_array($rolename, $_POST['adminmembers']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
				$roles->moveNext();
			}
			echo "\t\t\t</select>\n";
			echo "\t\t</td>\n\t</tr>\n";
		}
		
		echo "</table>\n";
		echo "<p><input type=\"hidden\" name=\"action\" value=\"save_create\" />\n";
		echo "<input type=\"submit\" name=\"create\" value=\"{$lang['strcreate']}\" />\n";
		echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
		echo "</form>\n";
	}
	
	/**
	 * Actually creates the new role in the database
	 */
	function doSaveCreate() {
		global $data, $lang;

		if(!isset($_POST['memberof'])) $_POST['memberof'] = array();
		if(!isset($_POST['members'])) $_POST['members'] = array();
		if(!isset($_POST['adminmembers'])) $_POST['adminmembers'] = array();
		
		// Check data
		if ($_POST['formRolename'] == '')
			doCreate($lang['strroleneedsname']);
		else if ($_POST['formPassword'] != $_POST['formConfirm'])
			doCreate($lang['strpasswordconfirm']);
		else {		
			$status = $data->createRole($_POST['formRolename'], $_POST['formPassword'], isset($_POST['formSuper']), 
				isset($_POST['formCreateDB']), isset($_POST['formCreateRole']), isset($_POST['formInherits']), 
				isset($_POST['formCanLogin']), $_POST['formConnLimit'], $_POST['formExpires'], $_POST['memberof'], $_POST['members'],
				$_POST['adminmembers']);
			if ($status == 0)
				doDefault($lang['strrolecreated']);
			else
				doCreate($lang['strrolecreatedbad']);
		}
	}	

	/**
	 * Function to allow alter a role
	 */
	function doAlter($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;

		$misc->printTrail('role');
		$misc->printTitle($lang['stralterrole'],'pg.role.alter');
		$misc->printMsg($msg);
				
		$roledata = $data->getRole($_REQUEST['rolename']);
		
		if ($roledata->recordCount() > 0) {
			$server_info = $misc->getServerInfo();
			$canRename = $data->hasUserRename() && ($_REQUEST['rolename'] != $server_info['username']);
			$roledata->f['rolsuper'] = $data->phpBool($roledata->f['rolsuper']);
			$roledata->f['rolcreatedb'] = $data->phpBool($roledata->f['rolcreatedb']);
			$roledata->f['rolcreaterole'] = $data->phpBool($roledata->f['rolcreaterole']);
			$roledata->f['rolinherit'] = $data->phpBool($roledata->f['rolinherit']);
			$roledata->f['rolcanlogin'] = $data->phpBool($roledata->f['rolcanlogin']);

			if (!isset($_POST['formExpires'])){
				if ($canRename) $_POST['formNewRoleName'] = $roledata->f['rolname'];
				if ($roledata->f['rolsuper']) $_POST['formSuper'] = '';
				if ($roledata->f['rolcreatedb']) $_POST['formCreateDB'] = '';
				if ($roledata->f['rolcreaterole']) $_POST['formCreateRole'] = '';
				if ($roledata->f['rolinherit']) $_POST['formInherits'] = '';
				if ($roledata->f['rolcanlogin']) $_POST['formCanLogin'] = '';
				$_POST['formConnLimit'] = $roledata->f['rolconnlimit'] == '-1' ? '' : $roledata->f['rolconnlimit'];
				$_POST['formExpires'] = $roledata->f['rolvaliduntil'] == 'infinity' ? '' : $roledata->f['rolvaliduntil'];
				$_POST['formPassword'] = '';
			}
		
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo $misc->form;
			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\" width=\"130\">{$lang['strrolename']}</th>\n";
			echo "\t\t<td class=\"data1\">", ($canRename ? "<input name=\"formNewRoleName\" size=\"15\" maxlength=\"15\" value=\"" . htmlspecialchars($_POST['formNewRoleName']) . "\" />" : $misc->printVal($roledata->f['rolname'])), "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strpassword']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"password\" size=\"15\" maxlength=\"32\" name=\"formPassword\" value=\"", htmlspecialchars($_POST['formPassword']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconfirm']}</th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"password\" size=\"15\" maxlength=\"32\" name=\"formConfirm\" value=\"\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formSuper\">{$lang['strsuper']}</label></th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formSuper\" name=\"formSuper\"", 
				(isset($_POST['formSuper'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCreateDB\">{$lang['strcreatedb']}</label></th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCreateDB\" name=\"formCreateDB\"", 
				(isset($_POST['formCreateDB'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCreateRole\">{$lang['strcancreaterole']}</label></th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCreateRole\" name=\"formCreateRole\"", 
				(isset($_POST['formCreateRole'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formInherits\">{$lang['strinheritsprivs']}</label></th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formInherits\" name=\"formInherits\"", 
				(isset($_POST['formInherits'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\"><label for=\"formCanLogin\">{$lang['strcanlogin']}</label></th>\n";
			echo "\t\t<td class=\"data1\"><input type=\"checkbox\" id=\"formCanLogin\" name=\"formCanLogin\"", 
				(isset($_POST['formCanLogin'])) ? ' checked="checked"' : '', " /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strconnlimit']}</th>\n";
			echo "\t\t<td class=\"data1\"><input size=\"4\" maxlength=\"4\" name=\"formConnLimit\" value=\"", htmlspecialchars($_POST['formConnLimit']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strexpires']}</th>\n";
			echo "\t\t<td class=\"data1\"><input size=\"23\" maxlength=\"60\" name=\"formExpires\" value=\"", htmlspecialchars($_POST['formExpires']), "\" /></td>\n\t</tr>\n";

			if (!isset($_POST['memberof']))
			{
				$memberof = $data->getMemberOf($_REQUEST['rolename']);
				if ($memberof->recordCount() > 0) {
					$i = 0;
					while (!$memberof->EOF) {
						$_POST['memberof'][$i++] = $memberof->f['rolname'];
						$memberof->moveNext();
					}
				}
				else
					$_POST['memberof'] = array();
				$memberofold = implode(',', $_POST['memberof']);
			}
			if (!isset($_POST['members']))
			{
				$members = $data->getMembers($_REQUEST['rolename']);
				if ($members->recordCount() > 0) {
					$i = 0;
					while (!$members->EOF) {
						$_POST['members'][$i++] = $members->f['rolname'];
						$members->moveNext();
					}
				}
				else
					$_POST['members'] = array();
				$membersold = implode(',', $_POST['members']);
			}
			if (!isset($_POST['adminmembers']))
			{
				$adminmembers = $data->getMembers($_REQUEST['rolename'], 't');
				if ($adminmembers->recordCount() > 0) {
					$i = 0;
					while (!$adminmembers->EOF) {
						$_POST['adminmembers'][$i++] = $adminmembers->f['rolname'];
						$adminmembers->moveNext();
					}
				}
				else
					$_POST['adminmembers'] = array();
				$adminmembersold = implode(',', $_POST['adminmembers']);
			}
			
			$roles = $data->getRoles($_REQUEST['rolename']);
			if ($roles->recordCount() > 0) {
				echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strmemberof']}</th>\n";
				echo "\t\t<td class=\"data\">\n";
				echo "\t\t\t<select name=\"memberof[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
				while (!$roles->EOF) {
					$rolename = $roles->f['rolname'];
					echo "\t\t\t\t<option value=\"{$rolename}\"",
					(in_array($rolename, $_POST['memberof']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
					$roles->moveNext();
				}
				echo "\t\t\t</select>\n";
				echo "\t\t</td>\n\t</tr>\n";
			
				$roles->moveFirst();
				echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['strmembers']}</th>\n";
				echo "\t\t<td class=\"data\">\n";
				echo "\t\t\t<select name=\"members[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
				while (!$roles->EOF) {
					$rolename = $roles->f['rolname'];
					echo "\t\t\t\t<option value=\"{$rolename}\"",
					(in_array($rolename, $_POST['members']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
					$roles->moveNext();
				}
				echo "\t\t\t</select>\n";
				echo "\t\t</td>\n\t</tr>\n";

				$roles->moveFirst();
				echo "\t<tr>\n\t\t<th class=\"data left\">{$lang['stradminmembers']}</th>\n";
				echo "\t\t<td class=\"data\">\n";
				echo "\t\t\t<select name=\"adminmembers[]\" multiple=\"multiple\" size=\"", min(20, $roles->recordCount()), "\">\n";
				while (!$roles->EOF) {
					$rolename = $roles->f['rolname'];
					echo "\t\t\t\t<option value=\"{$rolename}\"",
					(in_array($rolename, $_POST['adminmembers']) ? ' selected="selected"' : ''), ">", $misc->printVal($rolename), "</option>\n";
					$roles->moveNext();
				}
				echo "\t\t\t</select>\n";
				echo "\t\t</td>\n\t</tr>\n";
			}
			echo "</table>\n";

			echo "<p><input type=\"hidden\" name=\"action\" value=\"save_alter\" />\n";
			echo "<input type=\"hidden\" name=\"rolename\" value=\"", htmlspecialchars($_REQUEST['rolename']), "\" />\n";
			echo "<input type=\"hidden\" name=\"memberofold\" value=\"", isset($_POST['memberofold']) ? $_POST['memberofold'] : htmlspecialchars($memberofold), "\" />\n";
			echo "<input type=\"hidden\" name=\"membersold\" value=\"", isset($_POST['membersold']) ? $_POST['membersold'] : htmlspecialchars($membersold), "\" />\n";
			echo "<input type=\"hidden\" name=\"adminmembersold\" value=\"", isset($_POST['adminmembersold']) ? $_POST['adminmembersold'] : htmlspecialchars($adminmembersold), "\" />\n";
			echo "<input type=\"submit\" name=\"alter\" value=\"{$lang['stralter']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" /></p>\n";
			echo "</form>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
	}
	
	/** 
	 * Function to save after editing a role
	 */
	function doSaveAlter() {
		global $data, $lang;

		if(!isset($_POST['memberof'])) $_POST['memberof'] = array();
		if(!isset($_POST['members'])) $_POST['members'] = array();
		if(!isset($_POST['adminmembers'])) $_POST['adminmembers'] = array();

		// Check name and password
		if (isset($_POST['formNewRoleName']) && $_POST['formNewRoleName'] == '')
			doAlter($lang['strroleneedsname']);
		else if ($_POST['formPassword'] != $_POST['formConfirm'])
			doAlter($lang['strpasswordconfirm']);
		else {
			if (isset($_POST['formNewRoleName'])) $status = $data->setRenameRole($_POST['rolename'], $_POST['formPassword'], isset($_POST['formSuper']), isset($_POST['formCreateDB']), isset($_POST['formCreateRole']), isset($_POST['formInherits']), isset($_POST['formCanLogin']), $_POST['formConnLimit'], $_POST['formExpires'], $_POST['memberof'], $_POST['members'], $_POST['adminmembers'], $_POST['memberofold'], $_POST['membersold'], $_POST['adminmembersold'], $_POST['formNewRoleName']);
			else $status = $data->setRole($_POST['rolename'], $_POST['formPassword'], isset($_POST['formSuper']), isset($_POST['formCreateDB']), isset($_POST['formCreateRole']), isset($_POST['formInherits']), isset($_POST['formCanLogin']), $_POST['formConnLimit'], $_POST['formExpires'], $_POST['memberof'], $_POST['members'], $_POST['adminmembers'], $_POST['memberofold'], $_POST['membersold'], $_POST['adminmembersold']);
			if ($status == 0)
				doDefault($lang['strroleupdated']);
			else
				doAlter($lang['strroleupdatedbad']);
		}
	}

	/**
	 * Show confirmation of drop a role and perform actual drop
	 */
	function doDrop($confirm) {
		global $data, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) {
			$misc->printTrail('role');
			$misc->printTitle($lang['strdroprole'],'pg.role.drop');
			
			echo "<p>", sprintf($lang['strconfdroprole'], $misc->printVal($_REQUEST['rolename'])), "</p>\n";	
			
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo $misc->form;
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"rolename\" value=\"", htmlspecialchars($_REQUEST['rolename']), "\" />\n";
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $data->dropRole($_REQUEST['rolename']);
			if ($status == 0)
				doDefault($lang['strroledropped']);
			else
				doDefault($lang['strroledroppedbad']);
		}		
	}
	
	/**
	 * Show the properties of a role
	 */
	function doProperties($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;

		$misc->printTrail('role');
		$misc->printTitle($lang['strproperties'],'pg.role');
		$misc->printMsg($msg);
			
		$roledata = $data->getRole($_REQUEST['rolename']);
		if($roledata->recordCount() > 0 ) {
			$roledata->f['rolsuper'] = $data->phpBool($roledata->f['rolsuper']);
			$roledata->f['rolcreatedb'] = $data->phpBool($roledata->f['rolcreatedb']);
			$roledata->f['rolcreaterole'] = $data->phpBool($roledata->f['rolcreaterole']);
			$roledata->f['rolinherit'] = $data->phpBool($roledata->f['rolinherit']);
			$roledata->f['rolcanlogin'] = $data->phpBool($roledata->f['rolcanlogin']);

			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data\" width=\"130\">Description</th>\n";
			echo "\t\t<th class=\"data\" width=\"120\">Value</th>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strrolename']}</td>\n";
			echo "\t\t<td class=\"data1\">", htmlspecialchars($_REQUEST['rolename']), "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['strsuper']}</td>\n";
			echo "\t\t<td class=\"data2\">", (($roledata->f['rolsuper']) ? $lang['stryes'] : $lang['strno']), "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strcreatedb']}</td>\n";
			echo "\t\t<td class=\"data1\">", (($roledata->f['rolcreatedb']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['strcancreaterole']}</td>\n";
			echo "\t\t<td class=\"data2\">", (($roledata->f['rolcreaterole']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strinheritsprivs']}</td>\n";
			echo "\t\t<td class=\"data1\">", (($roledata->f['rolinherit']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['strcanlogin']}</td>\n";
			echo "\t\t<td class=\"data2\">", (($roledata->f['rolcanlogin']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strconnlimit']}</td>\n";
			echo "\t\t<td class=\"data1\">", ($roledata->f['rolconnlimit'] == '-1' ? $lang['strnolimit'] : $misc->printVal($roledata->f['rolconnlimit'])), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['strexpires']}</td>\n";
			echo "\t\t<td class=\"data2\">", ($roledata->f['rolvaliduntil'] == 'infinity' ? $lang['strnever'] : $misc->printVal($roledata->f['rolvaliduntil'])), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strsessiondefaults']}</td>\n";
			echo "\t\t<td class=\"data1\">", $misc->printVal($roledata->f['rolconfig']), "</td>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['strmemberof']}</td>\n";
			echo "\t\t<td class=\"data2\">";
			$memberof = $data->getMemberOf($_REQUEST['rolename']);
			if ($memberof->recordCount() > 0) {	
				while (!$memberof->EOF) {
					echo $misc->printVal($memberof->f['rolname']), "<br />\n";
					$memberof->moveNext();
				}
			}
			echo "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">{$lang['strmembers']}</td>\n";
			echo "\t\t<td class=\"data1\">";
			$members = $data->getMembers($_REQUEST['rolename']);
			if ($members->recordCount() > 0) {
				while (!$members->EOF) {
					echo $misc->printVal($members->f['rolname']), "<br />\n";
					$members->moveNext();
				}
			}
			echo "</td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data2\">{$lang['stradminmembers']}</td>\n";
			echo "\t\t<td class=\"data2\">";
			$adminmembers = $data->getMembers($_REQUEST['rolename'], 't');
			if ($adminmembers->recordCount() > 0) {
				while (!$adminmembers->EOF) {
					echo $misc->printVal($adminmembers->f['rolname']), "<br />\n";
					$adminmembers->moveNext();
				}
			}
			echo "</td>\n\t</tr>\n";
			echo "</table>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";

		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?{$misc->href}\">{$lang['strshowallroles']}</a> |\n";
		echo "<a class=\"navlink\" href=\"$PHP_SELF?action=alter&amp;{$misc->href}&amp;rolename=", 
			urlencode($_REQUEST['rolename']), "\">{$lang['stralter']}</a> |\n";
		echo "<a class=\"navlink\" href=\"$PHP_SELF?action=confirm_drop&amp;{$misc->href}&amp;rolename=",
			urlencode($_REQUEST['rolename']), "\">{$lang['strdrop']}</a>\n";
	}

	/**
	 * If a role is not a superuser role, then we have an 'account management'
	 * page for change his password, etc.  We don't prevent them from
	 * messing with the URL to gain access to other role admin stuff, because
	 * the PostgreSQL permissions will prevent them changing anything anyway.
	 */
	function doAccount($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
		
		$server_info = $misc->getServerInfo();
		
		$roledata = $data->getRole($server_info['username']);
		$_REQUEST['rolename'] = $server_info['username'];
		
		$misc->printTrail('role');
		$misc->printTabs('server','account');
		$misc->printMsg($msg);

		if ($roledata->recordCount() > 0) {
			$roledata->f['rolsuper'] = $data->phpBool($roledata->f['rolsuper']);
			$roledata->f['rolcreatedb'] = $data->phpBool($roledata->f['rolcreatedb']);
			$roledata->f['rolcreaterole'] = $data->phpBool($roledata->f['rolcreaterole']);
			$roledata->f['rolinherit'] = $data->phpBool($roledata->f['rolinherit']);
			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data\">{$lang['strrolename']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strsuper']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strcreatedb']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strcancreaterole']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strinheritsprivs']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strconnlimit']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strexpires']}</th>\n";
			echo "\t\t<th class=\"data\">{$lang['strsessiondefaults']}</th>\n";
			echo "\t</tr>\n";
			echo "\t<tr>\n\t\t<td class=\"data1\">", $misc->printVal($roledata->f['rolname']), "</td>\n";
			echo "\t\t<td class=\"data1\" id=\"center\">", (($roledata->f['rolsuper']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t\t<td class=\"data1\" id=\"center\">", (($roledata->f['rolcreatedb']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t\t<td class=\"data1\" id=\"center\">", (($roledata->f['rolcreaterole']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t\t<td class=\"data1\" id=\"center\">", (($roledata->f['rolinherit']) ? $lang['stryes'] : $lang['strno']), "</td>\n";
			echo "\t\t<td class=\"data1\" id=\"center\">", ($roledata->f['rolconnlimit'] == '-1' ? $lang['strnolimit'] : $misc->printVal($roledata->f['rolconnlimit'])), "</td>\n";
			echo "\t\t<td class=\"data1\">", ($roledata->f['rolvaliduntil'] == 'infinity' ? $lang['strnever'] : $misc->printVal($roledata->f['rolvaliduntil'])), "</td>\n";
			echo "\t\t<td class=\"data1\">", $misc->printVal($roledata->f['rolconfig']), "</td>\n";
			echo "\t</tr>\n</table>\n";
		}
		else echo "<p>{$lang['strnodata']}</p>\n";
		
		echo "<p><a class=\"navlink\" href=\"{$PHP_SELF}?action=confchangepassword&amp;{$misc->href}\">{$lang['strchangepassword']}</a></p>\n";
	}
	
	/**
	 * Show confirmation of change password and actually change password
	 */
	function doChangePassword($confirm, $msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang, $conf;
		
		$server_info = $misc->getServerInfo();
		
		if ($confirm) {
			$_REQUEST['rolename'] = $server_info['username'];
			$misc->printTrail('role');
			$misc->printTitle($lang['strchangepassword'],'pg.role.alter');
			$misc->printMsg($msg);
			
			if (!isset($_POST['password'])) $_POST['password'] = '';
			if (!isset($_POST['confirm'])) $_POST['confirm'] = '';
			
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo $misc->form;
			echo "<table>\n";
			echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strpassword']}</th>\n";
			echo "\t\t<td><input type=\"password\" name=\"password\" size=\"32\" value=\"", 
				htmlspecialchars($_POST['password']), "\" /></td>\n\t</tr>\n";
			echo "\t<tr>\n\t\t<th class=\"data left required\">{$lang['strconfirm']}</th>\n";
			echo "\t\t<td><input type=\"password\" name=\"confirm\" size=\"32\" value=\"\" /></td>\n\t</tr>\n";
			echo "<table>\n";
			echo "<p><input type=\"hidden\" name=\"action\" value=\"changepassword\" />\n";
			echo "<input type=\"submit\" name=\"ok\" value=\"{$lang['strok']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</p></form>\n";
		}
		else {
			// Check that password is minimum length
			if (strlen($_POST['password']) < $conf['min_password_length'])
				doChangePassword(true, $lang['strpasswordshort']);
			// Check that password matches confirmation password
			elseif ($_POST['password'] != $_POST['confirm'])
				doChangePassword(true, $lang['strpasswordconfirm']);
			else {
				$status = $data->changePassword($server_info['username'], $_POST['password']);
				if ($status == 0)
					doAccount($lang['strpasswordchanged']);
				else
					doAccount($lang['strpasswordchangedbad']);
			}
		}		
	}


	/**
	 * Show default list of roles in the database
	 */
	function doDefault($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;
		
		function renderRoleConnLimit($val) {
			return $val == '-1' ? 'No limit' : htmlspecialchars($val);
 		}
		
		function renderRoleExpires($val) {
			return $val == 'infinity' ? 'Never' : htmlspecialchars($val);
 		}
		
		$misc->printTrail('server');
		$misc->printTabs('server','roles');
		$misc->printMsg($msg);
		
		$roles = $data->getRoles();
		
		$columns = array(
			'rolename' => array(
				'title' => $lang['strrolename'],
				'field' => 'rolname',
			),
			'superuser' => array(
				'title' => $lang['strsuper'],
				'field' => 'rolsuper',
				'type'  => 'yesno',
			),
			'createdb' => array(
				'title' => $lang['strcreatedb'],
				'field' => 'rolcreatedb',
				'type'  => 'yesno',
			),
			'createrole' => array(
				'title' => $lang['strcancreaterole'],
				'field' => 'rolcreaterole',
				'type'  => 'yesno',
			),
			'inherits' => array(
				'title' => $lang['strinheritsprivs'],
				'field' => 'rolinherit',
				'type'  => 'yesno',
			),
			'canloging' => array(
				'title' => $lang['strcanlogin'],
				'field' => 'rolcanlogin',
				'type'  => 'yesno',
			),
			'expires' => array(
				'title' => $lang['strexpires'],
				'field' => 'rolvaliduntil',
				'type'  => 'callback',
				'params'=> array('function' => 'renderRoleExpires'),
			),
			'actions' => array(
				'title' => $lang['stractions'],
			),
		);
		
		$actions = array(
			'properties' => array(
				'title' => $lang['strproperties'],
				'url'   => "redirect.php?subject=role&amp;action=properties&amp;{$misc->href}&amp;",
				'vars'  => array('rolename' => 'rolname'),
			),		
			'alter' => array(
				'title' => $lang['stralter'],
				'url'   => "{$PHP_SELF}?action=alter&amp;{$misc->href}&amp;",
				'vars'  => array('rolename' => 'rolname'),
			),
			'drop' => array(
				'title' => $lang['strdrop'],
				'url'   => "{$PHP_SELF}?action=confirm_drop&amp;{$misc->href}&amp;",
				'vars'  => array('rolename' => 'rolname'),
			),
		);
		
		$misc->printTable($roles, $columns, $actions, $lang['strnoroles']);

		echo "<p><a class=\"navlink\" href=\"{$PHP_SELF}?action=create&amp;{$misc->href}\">{$lang['strcreaterole']}</a></p>\n";

	}

	$misc->printHeader($lang['strroles']);
	$misc->printBody();

	switch ($action) {
		case 'create':
			doCreate();
			break;
		case 'save_create':
			if (isset($_POST['create'])) doSaveCreate();
			else doDefault();
			break;
		case 'alter':
			doAlter();
			break;
		case 'save_alter':
			if (isset($_POST['alter'])) doSaveAlter();
			else doDefault();
			break;
		case 'confirm_drop':
			doDrop(true);
			break;
		case 'drop':
			if (isset($_POST['drop'])) doDrop(false);
			else doDefault();
			break;
		case 'properties':
			doProperties();
			break;
		case 'confchangepassword':
			doChangePassword(true);
			break;			
		case 'changepassword':
			if (isset($_REQUEST['ok'])) doChangePassword(false);
			else doAccount();
			break;
		case 'account':
			doAccount();
			break;
		default:
			doDefault();
	}	

	$misc->printFooter();

?>
