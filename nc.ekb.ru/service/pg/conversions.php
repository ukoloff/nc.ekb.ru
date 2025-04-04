<?php

	/**
	 * Manage conversions in a database
	 *
	 * $Id: conversions.php,v 1.12 2005/11/25 08:49:08 jollytoad Exp $
	 */

	// Include application functions
	include_once('./libraries/lib.inc.php');
	
	$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
	if (!isset($msg)) $msg = '';
	$PHP_SELF = $_SERVER['PHP_SELF'];

	/**
	 * Show default list of conversions in the database
	 */
	function doDefault($msg = '') {
		global $data, $conf, $misc, $database;
		global $PHP_SELF, $lang;

		$misc->printTrail('schema');
		$misc->printTabs('schema', 'conversions');
		$misc->printMsg($msg);
		
		$conversions = $data->getconversions();
		
		$columns = array(
			'conversion' => array(
				'title' => $lang['strname'],
				'field' => 'conname',
			),
			'source_encoding' => array(
				'title' => $lang['strsourceencoding'],
				'field' => 'conforencoding',
			),
			'target_encoding' => array(
				'title' => $lang['strtargetencoding'],
				'field' => 'contoencoding',
			),
			'default' => array(
				'title' => $lang['strdefault'],
				'field' => 'condefault',
				'type'  => 'yesno',
			),
			'comment' => array(
				'title' => $lang['strcomment'],
				'field' => 'concomment',
			),
		);
		
		$actions = array();
		
		$misc->printTable($conversions, $columns, $actions, $lang['strnoconversions']);
	}
	
	/**
	 * Generate XML for the browser tree.
	 */
	function doTree() {
		global $misc, $data;
		
		$conversions = $data->getconversions();
		
		$attrs = array(
			'text'   => field('conname'),
			'icon'   => 'Conversion',
			'toolTip'=> field('concomment')
		);
		
		$misc->printTreeXML($conversions, $attrs);
		exit;
	}
	
	if ($action == 'tree') doTree();
	
	$misc->printHeader($lang['strconversions']);
	$misc->printBody();

	switch ($action) {
		default:
			doDefault();
			break;
	}	

	$misc->printFooter();

?>
