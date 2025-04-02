<?
ldap_mod_del($CFG->AD->h, $CFG->udn, Array(lockoutTime=>Array(0)));
header('Location: ./'.hRef());
?>
