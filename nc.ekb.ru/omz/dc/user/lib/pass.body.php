<Form Method=POST Action='./' onSubmit='return Chk(this)'>
<?
LoadLib('/forms');
hiddenInputs();
?>
&raquo;Здесь <B>одновременно</B> меняется пароль на:<BR />
<LI>Вход в домен
<LI>Интернет и электронную почту
<LI>Сетевой центр (на этот сайт)
<LI>Файл-серверы (dbServ, KompaServ...)
<LI>А также всё, где понадобится впредь
<Table><TR vAlign=top><TD Align=Center>
<FieldSet>
<Legend>
Новый пароль
</Legend><P />
<Input Type='Password' Name=p1 /><P />
<Input Type='Password' Name=p2 /><P />
<Input Type='Submit' Value='Изменить пароль!' /><P />
</FieldSet>
</TD><TD>&nbsp;</TD>
<TD>
Обратите внимание:<BR />
<Small><UL>
<LI>Нельзя использовать в пароле русские буквы
<LI>Желательно, чтобы пароль состоял из латинских букв и цифр
<LI>Большие и малые буквы различаются (будьте внимательны к нажатым клавишам Shift и/или CapsLock)
<LI>Рекомендуемая длина пароля - не менее 8 символов
<LI>Система может <A hRef='/omz/me/newpass/' x-hRef='/help/pass/' Target='winPass'>предложить Вам на выбор</A> несколько паролей хорошего качества
<? if(0 and !isset($_GET['sync'])): ?>
<LI>Рекомендуем также <A hRef='/dc/user/<?=htmlspecialchars(hRef('u', $CFG->uxm, 'sync', 1))?>'
Target='_uxm'>синхронизировать пароль</A> для старого домена (LAN)
<? endif; ?>
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

function getPass()
{
 var p=document.forms[0].p1.value;
 if(!p.length) alert('Сначала введите пароль в этом окне, а потом нажмите ссылку "Синхронизировать".');
 return p;
}

<? if(isset($_GET['sync'])): ?>
function passSync()
{
 if(opener && opener.getPass) 
   onSetPass(opener.getPass());
}

passSync();
<? endif; ?>
//--></Script>
