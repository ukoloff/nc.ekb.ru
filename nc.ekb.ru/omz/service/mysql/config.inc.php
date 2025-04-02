<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * phpMyAdmin sample configuration, you can use it as base for
 * manual configuration. For easier setup you can use scripts/setup.php
 *
 * All directives are explained in Documentation.html and on phpMyAdmin
 * wiki <http://wiki.phpmyadmin.net>.
 *
 * @version $Id$
 */

/*
 * This is needed for cookie based authentication to encrypt password in
 * cookie
 */
$cfg['blowfish_secret'] = ''; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */

/*
 * Servers configuration
 */
$i = 0;

/*
 * First server
 */
$i++;
/* Authentication type */
//$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['auth_type'] = 'signon';
$cfg['Servers'][$i]['SignonSession']='pmaSignon';
$cfg['Servers'][$i]['SignonURL']='../mysql.auth/';
$cfg['Servers'][$i]['LogoutURL']='/omz/';
/* Server parameters */
//$cfg['Servers'][$i]['host'] = 'dbserv';
$cfg['Servers'][$i]['host'] = 'dbserv';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
/* Select mysqli if your server has it */
$cfg['Servers'][$i]['extension'] = 'mysql';
//$cfg['Servers'][$i]['user']            = 'root';
//$cfg['Servers'][$i]['password']        = 'AsUgAtE';

//$cfg['Servers'][$i]['AllowDeny']['order']='';
//$cfg['Servers'][$i]['AllowDeny']['rules']=array();

/* User for advanced features */
// $cfg['Servers'][$i]['controluser'] = 'pma';
// $cfg['Servers'][$i]['controlpass'] = 'pmapass';
/* Advanced phpMyAdmin features */
// $cfg['Servers'][$i]['pmadb'] = 'phpmyadmin';
// $cfg['Servers'][$i]['bookmarktable'] = 'pma_bookmark';
// $cfg['Servers'][$i]['relation'] = 'pma_relation';
// $cfg['Servers'][$i]['table_info'] = 'pma_table_info';
// $cfg['Servers'][$i]['table_coords'] = 'pma_table_coords';
// $cfg['Servers'][$i]['pdf_pages'] = 'pma_pdf_pages';
// $cfg['Servers'][$i]['column_info'] = 'pma_column_info';
// $cfg['Servers'][$i]['history'] = 'pma_history';
// $cfg['Servers'][$i]['designer_coords'] = 'pma_designer_coords';

/*
$i++;
$cfg['Servers'][$i]['auth_type'] = 'signon';
$cfg['Servers'][$i]['host'] = 'WiFi';
$cfg['Servers'][$i]['SignonSession']='pmaSigno';
$cfg['Servers'][$i]['SignonURL']='../mysql.auth/?n=2';
$cfg['Servers'][$i]['LogoutURL']='/omz/';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['extension'] = 'mysql';
*/
/*
 * End of servers configuration
 */

/*
 * Directories for saving/loading files from server
 */
$cfg['UploadDir'] = '';
$cfg['SaveDir'] = '';
$cfg['TempDir']='/var/tmp';

$cfg['LeftDisplayLogo']=false;
//$cfg['LeftFrameDBTree']=true;
//$cfg['LightTabs']=true;

$cfg['ShowPhpInfo']=true;
$cfg['ShowServerInfo']=true;
$cfg['ShowAll']=true;
$cfg['Order']='SMART';

?>
