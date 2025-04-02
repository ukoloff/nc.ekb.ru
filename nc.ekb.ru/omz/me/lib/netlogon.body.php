<?
if(!$CFG->Auth):
 LoadLib('auth');
 return;
endif;

$p=getEntry(user2dn($CFG->u), 'scriptPath');
$p=utf2str($p['scriptpath'][0]);
?>
<B>Скрипт подключения к домену</B>:
<?= htmlspecialchars($p) ?>
<Div Style='border: 2px groove; padding: 0.5ex;'>
<?
unset($fa);
LoadLib('/samba');
$Samba=new smbClient(netLogonPath());
$p=$Samba->winPath($p);
if($p) $fa=$Samba->fileAttrs($p);
if(!$fa or !$fa->isFile):
 echo "&raquo;\n", $p? "Файл не найден" : "Скрипт подключения не указан";
elseif(isset($_REQUEST['force']) or $fa->Size<10000 and preg_match('/\.(cmd|bat|txt)$/i', $fa->Name)):
 echo 
    nl2br(htmlspecialchars(iconv("CP866", "CP1251//IGNORE", file_get_contents($Samba->getFile($p)))));
else:
?>
&raquo;
Файл выглядит как двоичный. Если Вы всё же хотите его просмотреть нажмите
<A hRef='.\<?= htmlspecialchars(hRef('force', 'y')) ?>'>сюда.
<?
endif;
?>
</Div>
<Small>
&raquo;
На этой странице отображается скрипт подключения, то есть команды, исполняемые при каждом входе в домен.
</Small>
