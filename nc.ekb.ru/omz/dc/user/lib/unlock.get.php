<?
ldap_modify($CFG->AD->h, $CFG->udn, Array(lockoutTime=>Array(0)));
header('Location: ./'.hRef('x'));
exit;
?>
