<?
$CFG->AAA=1;

$X=Array(h=>'dbserv', s=>1);

if(inGroupX('#modifyDIT')):
 $X=2==$n? Array(u=>'w3', p=>'rfj[;tpyulcbaf', h=>'wifi.ekb.ru', s=>2) : Array(u=>'PMA', p=>'zyJnySUmwK8bdqFf');
elseif(inGroupX('Support')):
 $X=Array(u=>'PMA911', p=>'d4rScnshaEDDDYaX');
else:
 $CFG->AAA=2;
 return;
endif;

// session_set_cookie_params(0, '/', '', 0);
session_name('pmaSignon');
session_start();
$_SESSION['PMA_single_signon_user']=$X[u];
$_SESSION['PMA_single_signon_password']=$X[p];
$_SESSION['PMA_single_signon_host']=$X[h];
session_write_close();
Header('Location: ../mysql/');

?>
