<? //LoadLib('tsg'); ?>
<Div id='divLoading'><Center>
Подождите, идёт загрузка ActiveX-компонента...
</Center></Div>
<Div id='noActiveX' Style='display: none; color: red; text-align: center;'>
ActiveX-компонент не загружен. Удалённое соединение не может быть установлено!
</Div>
<? if(!$CFG->Connect) LoadLib('form'); ?>

<Script><!--
<? if($CFG->Connect): ?>
function doRDP(x)
{
<? if($CFG->Connect>1): ?>
 x.server=<?=jsEscape($_SERVER[HTTP_HOST])?>;
// x.server='<?=$_SERVER['SERVER_ADDR']?>';//'ekb.ru';
 x.AdvancedSettings2.RDPPort=<?=$CFG->RDP['Port']?>;
<? else: ?>
 x.server=<?=jsEscape($CFG->entry->s)?>;
<? endif; ?>
 x.FullScreenTitle=<?=jsEscape('RDP Web: '.$CFG->entry->s)?>;
 x.DesktopWidth=<?= $CFG->entry->w? $CFG->entry->w : 'screen.width' ?>;
 x.style.height=x.DesktopHeight=<?= $CFG->entry->w? calcH($CFG->entry->w) : 'screen.height' ?>;
<? if(!$CFG->entry->w): ?>
 x.FullScreen=1;
<? endif;
 if($CFG->entry->u): ?>
 x.UserName=<?=jsEscape($CFG->u)?>;
 x.Domain=<?=jsEscape($CFG->AD->Domain)?>;
<?
 endif;
 foreach(Array(/*'Clipboard'=>'clp', */'Drives'=>'drv',  'Printers'=>'prn',  'Ports'=>'prt',  'SmartCards'=>'crd') as $k=>$v): ?>
 x.AdvancedSettings2.Redirect<?=$k?>=<?= $CFG->entry->$v? 1 : 0 ?>;
<? 
 endforeach; 
?>
<?// x.AdvancedSettings2.ConnectToServerConsole=1; ?>
}
backTo=<?=jsEscape(hRef($CFG->entry))?>;
<?else:?>
doFocus();
<?endif;?>
//--></Script>
<Center>
<Object ID="MsRdpClient"
 ClassID="CLSID:7584c670-2274-4efb-b00b-d6aaba6d3850" CodeBase="msrdp.cab#version=5,2,3790,3959"
 onError="loadError()" onReadyStateChange='onReady()'
 Style='<?= $CFG->Connect? 'width: 100%' : 'display: none' ?>;'
></Object>
</Center>
<? if($CFG->Connect): ?>
<Div id='connectionOn' Style='display: none;'>
Установлено соединение с <?
 echo htmlspecialchars($CFG->entry->s);
 if($CFG->Connect>1) echo ' через ekb.ru';
?>
</Div>
<? else: ?>
<HR />
<Small>
&raquo;
Данная страница позволяет устанавливать терминальные соединения (Remote Desktop Protocol) сквозь корпоративный
брандмауэр ОАО "Уралхиммаш" в обе стороны (изнутри наружу и снаружи внутрь)
<BR />
&raquo;
Основным способом доступа к терминальным сервером извне остаётся 
<A hRef='/omz/help/TSG/'>шлюз терминалов</A>
<![if !IE]>
<Div>
&raquo;
Вероятно, эта возможность доступна только в браузере Microsoft Internet Explorer и недоступна в таких браузерах, как Google Chrome,
Firefox или Opera
</Div>
<![endif]>
<Div id='ie7security'>
&raquo;
Для MSIE версии 7 и лучше, если запуск ActiveX компонента блокирован настройками безопасности, запустите этот <A href='ekb.reg'>скрипт</A>,
перезапустите MSIE и попробуйте снова
</Div>
<?
$q=sqlite3_query($CFG->db, "Select Count(*) From Log Where u=".sqlite3_escape($CFG->u));
$r=sqlite3_fetch($q);
sqlite3_query_close($q);
if($r[0]):
?>
<Div>&raquo;
Ваша <A hRef='/omz/stat/?x=rdp'>статистика</A> терминального доступа
</Div>
<?endif;?>
</Small>
<? endif; ?>
