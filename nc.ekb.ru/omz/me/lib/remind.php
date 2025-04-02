<? // Вставляется на каждую страницу для эмуляции cron для https://ekb.ru/omz/me/?x=remind
if(!$CFG->Auth) return;

$u=AddSlashes($CFG->u);
$N=sqlGet("Select Count(*) From remind Where xtime<Now() And Disable=0 And Seen Is Null And u='$u'");
if($N):
?>
<Div Class='userReminder'><A hRef='/omz/me/?x=remind' Target='remind' title='У Вас есть напоминания' onClick='hideRemainder(this)'>&raquo;<?=$N?></A></Div>
<?
endif;
if(!sqlGet("Select id From remind Where xtime<Now() And Disable=0 And Mail<>0 And Sent Is Null Limit 1")) return;
?>
<iFrame Style='display: none;' Width='0' Height='0' FrameBorder='0' Src='/omz/me/remind/'></iFrame>
