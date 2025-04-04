<?php

	/**
	 * Manage operators in a database
	 *
	 * $Id: operators.php,v 1.22 2006/06/17 12:57:36 xzilla Exp $
	 */

	// Include application functions
	include_once('./libraries/lib.inc.php');
	
	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Show read only properties for an operator
	 */
	function doProperties($msg = '') {
		global $data, $misc;
		global $PHP_SELF, $lang;

		$misc->printTrail('operator');
		$misc->printTitle($lang['strproperties'],'pg.operator');
		$misc->printMsg($msg);
		
		$oprdata = $data->getOperator($_REQUEST['operator_oid']);
		$oprdata->f['oprcanhash'] = $data->phpBool($oprdata->f['oprcanhash']);

		if ($oprdata->recordCount() > 0) {
			echo "<table>\n";
			echo "<tr><th class=\"data left\">{$lang['strname']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprname']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strleftarg']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprleftname']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strrightarg']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprrightname']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strcommutator']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprcom']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strnegator']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprnegate']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strjoin']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprjoin']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strhashes']}</th>\n";
			echo "<td class=\"data1\">", ($oprdata->f['oprcanhash']) ? $lang['stryes'] : $lang['strno'], "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strmerges']}</th>\n";
			echo "<td class=\"data1\">", ($oprdata->f['oprlsortop'] !== '0' && $oprdata->f['oprrsortop'] !== '0') ? $lang['stryes'] : $lang['strno'], "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strrestrict']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprrest']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strleftsort']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprlsortop']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strrightsort']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprrsortop']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strlessthan']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprltcmpop']), "</td></tr>\n";
			echo "<tr><th class=\"data left\">{$lang['strgreaterthan']}</th>\n";
			echo "<td class=\"data1\">", $misc->printVal($oprdata->f['oprgtcmpop']), "</td></tr>\n";
			echo "</table>\n";

			echo "<p><a class=\"navlink\" href=\"$PHP_SELF?{$misc->href}\">{$lang['strshowalloperators']}</a></p>\n";
		}
		else
			doDefault($lang['strinvalidparam']);
	}

	/**
	 * Show confirmation of drop and perform actual drop
	 */
	function doDrop($confirm) {
		global $data, $misc;
		global $PHP_SELF, $lang;

		if ($confirm) {
			$misc->printTrail('operator');
			$misc->printTitle($lang['strdrop'], 'pg.operator.drop');
			
			echo "<p>", sprintf($lang['strconfdropoperator'], $misc->printVal($_REQUEST['operator'])), "</p>\n";	
			
			echo "<form action=\"$PHP_SELF\" method=\"post\">\n";
			echo "<input type=\"hidden\" name=\"action\" value=\"drop\" />\n";
			echo "<input type=\"hidden\" name=\"operator\" value=\"", htmlspecialchars($_REQUEST['operator']), "\" />\n";
			echo "<input type=\"hidden\" name=\"operator_oid\" value=\"", htmlspecialchars($_REQUEST['operator_oid']), "\" />\n";
			echo $misc->form;
			// Show cascade drop option if supportd
			if ($data->hasDropBehavior()) {
				echo "<p><input type=\"checkbox\" id=\"cascade\" name=\"cascade\" /> <label for=\"cascade\">{$lang['strcascade']}</label></p>\n";
			}
			echo "<input type=\"submit\" name=\"drop\" value=\"{$lang['strdrop']}\" />\n";
			echo "<input type=\"submit\" name=\"cancel\" value=\"{$lang['strcancel']}\" />\n";
			echo "</form>\n";
		}
		else {
			$status = $data->dropOperator($_POST['operator_oid'], isset($_POST['cascade']));
			if ($status == 0)
				doDefault($lang['stroperatordropped']);
			else
				doDefault($lang['stroperatordroppedbad']);
		}
		
	}
	
	/**
	 * Show default list of operators in the database
	 */
	function doDefault($msg = '') {
		global $data, $conf, $misc;
		global $PHP_SELF, $lang;
		
		$misc->printTrail('schema');
		$misc->printTabs('schema','operators');
		$misc->printMsg($msg);
		
		$operators = $data->getOperators();

		$columns = array(
			'operator' => array(
				'title' => $lang['stroperator'],
				'field' => 'oprname',
			),
			'leftarg' => array(
				'title' => $lang['strleftarg'],
				'field' => 'oprleftname',
			),
			'rightarg' => array(
				'title' => $lang['strrightarg'],
				'field' => 'oprrightname',
			),
			'returns' => array(
				'title' => $lang['strreturns'],
				'field' => 'resultname',
			),
			'actions' => array(
				'title' => $lang['stractions'],
			),
			'comment' => array(
				'title' => $lang['strcomment'],
				'field' => 'oprcomment',
			),
		);

		$actions = array(
			'properties' => array(
				'title' => $lang['strproperties'],
				'url'   => "{$PHP_SELF}?action=properties&amp;{$misc->href}&amp;",
				'vars'  => array('operator' => 'oprname', 'operator_oid' => 'oid'),
			),
			'drop' => array(
				'title' => $lang['strdrop'],
				'url'   => "{$PHP_SELF}?action=confirm_drop&amp;{$misc->href}&amp;",
				'vars'  => array('operator' => 'oprname', 'operator_oid' => 'oid'),
			),
		);
		
		$misc->printTable($operators, $columns, $actions, $lang['strnooperators']);
		
//		echo "<p><a class=\"navlink\" href=\"$PHP_SELF?action=create&amp;{$misc->href}\">{$lang['strcreateoperator']}</a></p>\n";
	}

	/**
	 * Generate XML for the browser tree.
	 */
	function doTree() {
		global $misc, $data, $PHP_SELF;
		
		$operators = $data->getOperators();
		
		// Operator prototype: "type operator type"
		$proto = concat(field('oprleftname'), ' ', field('oprname'), ' ', field('oprrightname'));
		
		$reqvars = $misc->getRequestVars('operator');
		
		$attrs = array(
			'text'   => $proto,
			'icon'   => 'Operator',
			'toolTip'=> field('oprcomment'),
			'action' => url('operators.php',
							$reqvars,
							array(
								'action'  => 'properties',
								'operator' => $proto,
								'operator_oid' => field('oid')
							)
						)
		);
		
		$misc->printTreeXML($operators, $attrs);
		exit;
	}
	
	if ($action == 'tree') doTree();
	
	$misc->printHeader($lang['stroperators']);
	$misc->printBody();

	switch ($action) {
		case 'save_create':
			if (isset($_POST['cancel'])) doDefault();
			else doSaveCreate();
			break;
		case 'create':
			doCreate();
			break;
		case 'drop':
			if (isset($_POST['cancel'])) doDefault();
			else doDrop(false);
			break;
		case 'confirm_drop':
			doDrop(true);
			break;			
		case 'properties':
			doProperties();
			break;
		default:
			doDefault();
			break;
	}	

	$misc->printFooter();

?>
