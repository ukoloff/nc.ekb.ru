<?
header('Content-Type: application/x-javascript');
header('Expires: 0');
header('cache-control: no-store');
?>
var i=setInterval(function()
{
 var w=window.opener;
 if(!w.document.forms.length) return;
 var f=w.document.forms[0];
 if(!f.username) return;
 clearInterval(i);
 f.username.value=<?=jsEscape($CFG->AD->Domain."\\".$CFG->u)?>;
 f.password.value='<?
$p=($CFG->Auth and 'https://srvmail-ekbh1.omzglobal.com/pass/'==$_SERVER['HTTP_REFERER'])?$_SERVER['PHP_AUTH_PW']:'';
for($i=0; $i<strlen($p); $i++) echo "\\x", bin2hex($p{$i});
?>';
  setTimeout(function(){window.close()}, 100);
}, 300);
