<?
$CFG->title='Тест';

ini_set('session.hash_function', 1);	//SHA1
ini_set('session.entropy_length', '4');
ini_set('session.entropy_file', '/dev/urandom');
ini_set('session.use_cookies', true);
ini_set('session.use_only_cookies', true);
ini_set('session.cookie_httponly', true);

session_name('ViDeO');
session_start();

?>
