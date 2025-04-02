<?
if($CFG->Auth<=0 and !$CFG->Error)
 $CFG->Error='Вы не прошли авторизацию';
?>
&raquo;Здесь Вы можете изменить свой пароль, используемый для:
<LI>Чтения электронной почты,
<LI>Доступа в Интернет и к <A hRef='/'>Сетевому центру</A>, 
<LI>Входа в домен и на файловые сервера (dbServ, KompaServ...)
<P />
<Center>
<Form Method=POST Action='./' onSubmit='return Chk(this)'>
<?
hiddenInputs();
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
<!-- <Span Class='Error'>Извините, смена пароля временно не работает</Span> -->
<Span Class='Error'>Извините, на время миграции в домен OMZGLOBAL самостоятельная смена пароля отключена.
<BR />Для смены пароля обращайтесь в службу техподдержки (тел. 78-50)</Span> 
<Table><TR vAlign=top><TD Align=Center>
<FieldSet>
<Legend>
Введите новый пароль
</Legend><P />
<Input Type=Password Name=p1><P />
<Input Type=Password Name=p2><P />
<Input Type=Submit Value='Изменить пароль!'<? if($CFG->Auth<=0) echo " Disabled"; ?>  Disabled /><P />
</FieldSet>
</TD><TD>&nbsp;</TD>
<TD>
Обратите внимание:
<Small><UL>
<LI>Нельзя использовать в пароле русские буквы
<LI>Желательно, чтобы пароль состоял из латинских букв и цифр
<LI>Большие и малые буквы различаются (будьте внимательны к нажатым клавишам Shift и/или CapsLock)
<LI>Рекомендуемая длина пароля - не менее 8 символов
<LI>Система может <A hRef='/help/pass/' Target='winPass'>предложить Вам на выбор</A> несколько паролей хорошего качества
</UL></Small>
</TD></TR></Table>
</Form>
</Center>

<UL>
<LI>Запомните введённый пароль и сохраните его копию в надёжном месте
<LI>Никогда и никому не сообщайте Ваш пароль, Вы несёте полную ответственность
за его сохранность, равно как и за все действия, совершённые под Вашей учётной записью
<LI>При возникновении любых подозрений, что Ваш пароль стал известен посторонним,
прежде всего зайдите на эту страницу и поменяйте пароль
</UL>

<Script><!--
document.forms[0].p1.focus();

function Chk(f)
{
 if(f.p1.value!=f.p2.value) alert('Пароли не совпадают!');
 else if(f.p1.value.length<3) alert('Пароль слишком короткий!');
 else return true;
 f.p1.focus();
 return false;
}

function onSetPass(p)
{
 var f=document.forms[0];
 f.p1.value=p;
 f.p2.value=p;
 f.p1.select();
}
//--></Script>
