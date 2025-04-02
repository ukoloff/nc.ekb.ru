<? // Рассылка уведомлений https://ekb.ru/omz/me/?x=remind
if(!$CFG->Auth) exit;

$NN=0;
while($r=mysql_fetch_object(mysql_query("Select * From remind Where xtime<Now() And Disable=0 And Mail<>0 And Sent Is Null Order By xtime Limit 1"))):
 if($NN++>10):
  Header('Refresh: 10');
  exit;
 endif;

 sendReminder($r);

 mysql_query("Update remind Set Sent=Now(), sender='".AddSlashes($CFG->u)."' Where id=".$r->id);
endwhile;

exit;

function sendReminder($r)
{
 $dn=user2dn($r->u);
 if(!$dn) return;
 $a=getEntry($dn, 'mail displayName');
 if(!$a[mail]) return;

 $subj=preg_replace('/\s*\n.*$/', '', trim($r->Info));
 if(!$subj)$subj=$r->ctime;
 $subj='Напоминание: '.$subj;

 $mail=headerEncode(utf2str($a[displayname][0])).'<'.utf2str($a[mail][0]).'>';

 mail(
  $mail,
  headerEncode($subj),
  base64_encode("<https://ekb.ru/omz/me/?x=remind&i={$r->id}&go>\r\n".
  trim($r->Info)."\r\n----------------------------------------\r\n".
  "Создано:\t".$r->ctime."\r\n".
  "Сработало:\t".$r->xtime."\r\n".
  "URL:\t\t".$r->URL."\r\n"),
  'From: '.$mail."\r\n".
//  'To: '.$mail."\r\n".	// Not needed for Exchange
  'X-Mailer: PHP '.phpversion()."\r\n".
  'X-Sent-From: http'.($_SERVER['HTTPS']?'s':'')."://".$_SERVER['SERVER_NAME']."/omz/me/?x=remind\r\n".
  "Organization: UralKhimMash <http://ekb.ru>\r\n".
  "MIME-Version: 1.0\r\n".
  "Content-Type: text/plain; charset=\"windows-1251\"\r\n".
  "Content-Transfer-Encoding: base64"
 );
}

?>
