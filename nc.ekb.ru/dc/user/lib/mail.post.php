<?

if(!$subject=trim($_REQUEST['subject'])) $subject='Вам письмо!';
$fromName=trim($_REQUEST['fromName']);
$fromU=trim($_REQUEST['fromU']);
$toName=trim($_REQUEST['toName']);
mail(
    $CFG->params->u, 
    headerEncode($subject),
    trim($_REQUEST['Hello'])."\n\n".
    trim($_REQUEST['body'])."\n\n".
    trim($_REQUEST['Bye'])."\n".
    $fromName."\t\t\t".trim($_REQUEST['fromU'])."@ekb.ru\n",
    'From: '.headerEncode($fromName)." <$fromU@ekb.ru>\r\n".
    'To: '.headerEncode($toName)." <".$CFG->params->u."@ekb.ru>\r\n".
    'X-Mailer: PHP '.phpversion()."\r\n".
    'X-Sent-From: http'.($_SERVER['HTTPS']?'s':'')."://".$CFG->u.'@'.$_SERVER['SERVER_NAME']."\r\n".
    'X-IP-From: '.$_SERVER['REMOTE_ADDR'].' '.$_SERVER["HTTP_X_FORWARDED_FOR"]."\r\n".
    "Organization: UralKhimMash http://ekb.ru\r\n".
    "MIME-Version: 1.0\r\n".
    "Content-Type: text/plain; charset=\"windows-1251\"\r\n".
    "Content-Transfer-Encoding: 8bit"
);

header('Location: ./'.hRef('x', null));

?>
