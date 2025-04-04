<?php

	/**
	 * Login screen
	 *
	 * $Id: login.php,v 1.32 2006/06/17 12:57:36 xzilla Exp $
	 */
	global $conf;
	
	// This needs to be an include once to prevent lib.inc.php infinite recursive includes.
	// Check to see if the configuration file exists, if not, explain
	require_once('./libraries/lib.inc.php');
	
	$misc->printHeader($lang['strlogin']);
	$misc->printBody();
	$misc->printTrail('root');
	
	$server_info = $misc->getServerInfo($_REQUEST['server']);
	
	$misc->printTitle(sprintf($lang['strlogintitle'], $server_info['desc']));
	
	if (isset($msg)) $misc->printMsg($msg);
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="login_form">
<?php
	if (!empty($_POST)) $vars =& $_POST;
	else $vars =& $_GET;
	// Pass request vars through form (is this a security risk???)
	foreach ($vars as $key => $val) {
		if (substr($key,0,5) == 'login') continue;
		echo "<input type=\"hidden\" name=\"", htmlspecialchars($key), "\" value=\"", htmlspecialchars($val), "\" />\n";
	}
?>
	<input type="hidden" name="loginServer" value="<?php echo htmlspecialchars($_REQUEST['server']); ?>" />
	<table class="navbar" border="0" cellpadding="5" cellspacing="3">
		<tr>
			<td><?php echo $lang['strusername']; ?></td>
			<td><input type="text" name="loginUsername" value="<?php if (isset($_POST['loginUsername'])) echo htmlspecialchars($_POST['loginUsername']); ?>" size="24" /></td>
		</tr>
		<tr>
			<td><?php echo $lang['strpassword']; ?></td>
			<td><input type="password" name="loginPassword" size="24" /></td>
		</tr>
	</table>
<?php if (sizeof($conf['servers']) > 1) : ?>
	<p><input type="checkbox" id="loginShared" name="loginShared" <?php echo isset($_POST['loginShared']) ? 'checked="checked"' : '' ?> /><label for="loginShared"><?php echo $lang['strtrycred'] ?></label></p>
<?php endif; ?>
	<p><input type="submit" name="loginSubmit" value="<?php echo $lang['strlogin']; ?>" /></p>
</form>

<script type="text/javascript">
<!--
	var uname = document.login_form.loginUsername;
	var pword = document.login_form.loginPassword;
	if (uname.value == "") {
		uname.focus();
	} else {
		pword.focus();
	}
//-->
</script>

<?php
	// Output footer
	$misc->printFooter();
?>
