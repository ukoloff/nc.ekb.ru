<? // Вывод сведений о пользователе
LoadLIb('/userPhoto');

function userInfo($u, $flags=0)
{
 global $CFG;

 $e=getEntry($udn=user2dn($u));
 $x=new dn($e['dn']);
 $x->Cut();
 $x=$x->ufn();
// if(($flags and 1) and $tabNo=utf2html($e['employeeid'][0]) and file_exists($_SERVER['DOCUMENT_ROOT'].($f="/img/photo/$tabNo.jpg")))
 if(($flags and 1) and hasPhoto($udn))
#  echo "<TR><TH>Фото</TH><TD><Img Src='$f' /></TD></TR>\n";
  echo "<Div Class='Photo' onMouseDown='onDown(this, event)' onMouseMove='onMove(this, event) '><Img Src='/abook/?jpg&u=", urlencode($u),
    "' Alt='Фото'/></Div>\n";
?>
<Style><!--
TH {
	text-align: right;
}
Div.Photo {
    position: absolute;
    margin: 0.5ex;
    border: 2px ridge;
    padding: 0.3ex;
    background: #A0C0F0;
}

Div.Photo Img {
    border: 2px ridge;
}
--></Style>
<Script Src='/dragPhoto.js'></Script>
<Table Border CellSpacing='0' Width='100%'>
<TR><TH>Учётная запись</TH><TD><?
 if($Strike=$e['useraccountcontrol'][0]& uac_ACCOUNTDISABLE) echo "<S>";
 echo htmlspecialchars($u);
 if($Strike) echo "</S>";
 if($CFG->u==$u)
  echo ", <A hRef='/?", $CFG->Auth>0? 
    "logout'>перерегистрироваться</A>" :
    "login'>ввести пароль для полного доступа</A>"; 
?>
</TD></TR>
<TR><TH>Подразделение</TH><TD><?= htmlspecialchars($x->str())?></TD></TR>
<TR><TH>Ф.И.О.</TH><TD><?= utf2html($e['sn'][0]) ?> <?= utf2html($e['givenname'][0]) ?> <?= utf2html($e['middlename'][0]) ?><BR /></TD></TR>
<?

 foreach(Array(/*'cn'=>"Пользователь", */'employeeID'=>'Табельный номер', 'displayName'=>"Показывать как", 'title'=>"Должность",
  'description'=>"Описание", 'telephoneNumber'=>"Телефон", 
  'physicalDeliveryOfficeName'=>"Комната", 'info'=>"Заметки") as $k=>$v):
  echo "<TR><TH>$v</TH>\n<TD>", nl2br(utf2html($e[strtolower($k)][0])), "<BR /></TD></TR>\n";
 endforeach;
?>
<TR><TH>Электронная почта</TH><TD><?
 if($e['mssfu30nisdomain'][0]):
  $email="$u@ekb.ru";
  echo '<A hRef="mailto:', htmlspecialchars(urlencode($email)), '">',  htmlspecialchars($email), '</A>';
 else:
  echo 'Нет';
 endif;
?>
</TD></TR>
<?
if(0==($flags & 2)):
?>
<TR><TH>Доступ в Интернет</TH><TD><?
 if(!$Squid=inGroupX('squid', $u)): 
  echo 'Не предоставлен';
 elseif(!inGroupX('#squid', $u)):
  echo "Открыт";
//, $limit? ", $limit Мегабайт в месяц" : " и неограничен"; 
 else:
  echo "Закрыт";
  if(inGroupX('(squid)')) echo ", превышение месячного лимита"; //, $limit, ' Мегабайт в месяц';
 endif;
 if($Squid):
  LoadLib('/mysql');
  $L=sqlGet("Select freeMb, limitMb from limits Where u='".AddSlashes($u)."'");
  echo "</TD><TR><TH>Бесплатный трафик</TH><TD>", ''!=$L->freeMb? $L->freeMb.' Мб/месяц':'Весь',
    "</TD></TR><TR><TH>Порог отключения</TH><TD>", ''!=$L->limitMb? $L->limitMb.' Мб/месяц':'Не задан';
 endif;
?>
</TD></TR>
<?
endif;

if(inGroupX('#browseDIT')):
 setlocale(LC_ALL, "ru_RU.cp1251");

 foreach(Array('Создан'=>'created', 'Изменён'=>'changed') as $k=>$v):
  echo "<TR><TH>$k</TH><TD>";
  $DT=utf2str($e["when$v"][0]);
  $DT=gmmktime(substr($DT, 8, 2), substr($DT, 10, 2), substr($DT, 12, 2), 
	    substr($DT, 4, 2), substr($DT, 6, 2), substr($DT, 0, 4));
  echo strftime("%x %X", $DT),  "</TD></TR>\n";
 endforeach;
endif;

?>
<TR><TH>Визитная карточка</TH><TD><A hRef='/abook/?vcf&u=<?=urlencode($u)?>' Title='Получить файл с визитной карточкой'>Загрузить</A></TD></TR>
</Table>
<?
}

?>
