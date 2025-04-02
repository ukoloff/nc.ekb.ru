<?
$z=(int)$_REQUEST['z'];

mysql_query("Insert Into uxmJournal.Provider(u, id, Name, IP) Values ('".
    AddSlashes($CFG->u)."', $z, '".$CFG->Z[$z]."', '".$_SERVER['REMOTE_ADDR']."')");
    
$c=curl_init($CFG->URL);
curl_setopt_array($c, Array(
 CURLOPT_SSL_VERIFYPEER=>false,
 CURLOPT_RETURNTRANSFER=>1,
 CURLOPT_POST=>1,
 CURLOPT_POSTFIELDS=>"z=$z",
 CURLOPT_HTTPAUTH=>CURLAUTH_BASIC,
 CURLOPT_USERPWD=>$_SERVER['PHP_AUTH_USER'].':'.$_SERVER['PHP_AUTH_PW']
));
curl_exec($c);
curl_close($c);

Header('Location: ./');
exit;
?>
