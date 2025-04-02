<?

if(!$subject=trim($_REQUEST['subject'])) $subject='Вам письмо!';
$fromName=trim($_REQUEST['fromName']);
//$fromU=trim($_REQUEST['fromU']);
$toName=trim($_REQUEST['toName']);

$e=getEntry($udn=user2dn($CFG->params->u), 'mail');
$toMail=utf2str($e['mail'][0]);

$me = getEntry(user2dn($CFG->u), 'displayName cn mail');
if(!$tooName = $me['displayname'][0]) $tooName = $me['cn'][0];
$tooName=utf2str($tooName);
$too = utf2str($me['mail'][0]);

$nc = getEntry(user2dn('nc.ekb.ru'), 'displayName cn mail');
$fromU = utf2str($nc['mail'][0]);

include('Mail.php');

$H=Array();
$H['From']=headerEncode($fromName).' <'.$fromU.'>';
$H['To']=headerEncode($toName).' <'.$toMail.'>';
//$H['Reply-To']=headerEncode($tooName).' <'.$too.'>';
$H['Reply-To']=headerEncode('Техподдержка').' <sd@ekb.ru>';
$H['Subject']=headerEncode($subject);
$H['X-Mailer']='PHP '.phpversion();
$H['X-Sent-From']='https://'.$CFG->u.'@nc.ekb.ru/omz/';
$H['X-IP-From']=$_SERVER['REMOTE_ADDR'].' '.$_SERVER["HTTP_X_FORWARDED_FOR"];
$H["Organization"]="UralHimMash <https://uralhimmash.ru/>";
$H["MIME-Version"]='1.0';
$H["Content-Type"]="text/plain; charset=\"windows-1251\"";
$H["Content-Transfer-Encoding"]="8bit";

//echo "<pre>"; print_r($H); exit();

$Z=&Mail::factory('sendmail', Array('sendmail_args'=>'-i -N never'));
$Z->send($toMail, $H, 
    trim($_REQUEST['Hello'])."\n\n".
    str_replace("\r\n", "\n", trim($_REQUEST['body']))/* ."\n\n---\n".
    trim($_REQUEST['Bye']) */ );

/*
mail(
    $toMail, 
    headerEncode($subject),
    trim($_REQUEST['Hello'])."\n\n".
    trim($_REQUEST['body'])."\n\n".
    trim($_REQUEST['Bye'])."\n".
    $fromName."\t\t\t".trim($_REQUEST['fromU'])."\n",
    'From: '.headerEncode($fromName)." <$fromU>\r\n".
    'To: '.headerEncode($toName)." <".$toMail.">\r\n".
    'X-Mailer: PHP '.phpversion()."\r\n".
    'X-Sent-From: http'.($_SERVER['HTTPS']?'s':'')."://".$CFG->u.'@'.$_SERVER['SERVER_NAME']."/omz/\r\n".
    'x-originating-ip: ['.$_SERVER['REMOTE_ADDR']."]\r\n".
    "Organization: UralKhimMash http://ekb.ru\r\n".
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/plain; charset=\"windows-1251\"\r\n".
    "Content-Transfer-Encoding: 8bit"
);
*/

header('Location: ./'.hRef('x', null));

?>
