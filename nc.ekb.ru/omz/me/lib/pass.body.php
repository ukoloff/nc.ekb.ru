<? if(!$CFG->Auth) LoadLib('auth'); ?>
<Form Method=POST Action='./' onSubmit='return Chk(this)'>
<?
hiddenInputs();
if($CFG->Error) echo "<H2 class='Error'>", htmlspecialchars($CFG->Error), "</H2>\n";
?>
&raquo;Здесь <B>одновременно</B> меняется Ваш пароль на:<BR />
<LI>Вход в домен
<LI>Интернет и электронную почту
<LI>Сетевой центр (на этот сайт)
<LI>Файл-серверы (dbServ, KompaServ...)
<LI>А также всё, что понадобится впредь &copy;...
<Table><TR vAlign=top><TD Align=Center>
<FieldSet>
<Legend>
Новый пароль
</Legend><P />
<Input Type='Password' Name=p1 /><P />
<Input Type='Password' Name=p2 /><P />
<Input Type='Submit' Value='Изменить пароль!' <? if(!$CFG->Auth) echo 'Disabled '; ?>/><P />
</FieldSet>
</TD><TD>&nbsp;</TD>
<TD>
Обратите внимание:<BR />
<Small><UL>
<LI>Нельзя использовать в пароле русские буквы
<LI>Желательно, чтобы пароль состоял из латинских букв, цифр и знаков препинания
<LI>Большие и малые буквы различаются (будьте внимательны к нажатым клавишам Shift и/или CapsLock)
<LI>Рекомендуемая длина пароля - не менее 8 символов
<LI>Система может <A hRef='/omz/me/newpass/'  Target='winPass'>предложить Вам на выбор</A> несколько паролей хорошего качества
</UL></Small>
</TD></TR></Table>
</Form>
</Center>
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
<Small>
&raquo;
Если смена пароля не работает - обращайтесь в <A hRef='mailto:911@ekb.ru'>службу тех. поддержки</A>, тел. 78-50.
