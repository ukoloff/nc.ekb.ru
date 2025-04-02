<Script><!--
function doDrop(N, A)
{
 A.blur();
 if(!confirm('Действительно разорвать это соединение?')) return;
 var f=findId('dropForm');
 f.Drop.value=N;
 f.submit();
 A.innerHTML=A.innerHTML.strike();
 A.onclick=function(){return false;}
 findId('DropNote').style.display='';
}
//--></Script>
<H2>Активные сессии
</H2>
<Form id='dropForm' Action='./' Method='POST' Target='Drop'>
<Table Border CellSpacing='0' Width='100%'>
<TR Class='tHeader'>
<TH>Доступ</TH>
<TH>Начало</TH>
<TH Title='Способ авторизации:
D - домен
T - билет
Q - повторный вход'>Тип</TH>
<TH>IP/MAC</TH>
<TH>Устройство</TH>
</TR>
<?
$CFG->params->Drop='-';
hiddenInputs();

$s=$CFG->WiFi->db->prepare(<<<SQL
Select conn.*, ua.*,
 (Select Count(*) From stop Where id=conn.id) As Stop
From online Inner Join conn Using(id) Join ua Using(id) Inner Join user On conn.u=user.id
Where user.id=?
Order By conn.id
SQL
);
$s->execute(Array($CFG->WiFi->user));
$X=explode('/', 'Закрыт/Локальная сеть/Интернет/Полный');
while($r=$s->fetchObject()):
 $AX=$r->Stop? '<s>' : "<A hRef='#' Title='Разорвать соединение' onClick='doDrop({$r->id}, this); return false;'>";
 $AY=$r->Stop? '</s>' : '</A>';
 echo "<TR>",
    "<TD Align='Center'>$AX", $X[(int)!!$r->int+2*(int)!!$r->ext], "$AY<BR /></TD>",
    "<TD>", $r->ctime, "<BR /></TD>",
    "<TD Align='Center'>", $r->meth, "<BR /></TD>",
    "<TD>", $r->IP, "<BR />",
    $r->MAC, "<BR /></TD>",
    "<TD><Small>", htmlspecialchars($r->userAgent), "</Small><BR /></TD>",
    "</TR>\n";
endwhile;
?>
</Table>
</Form>
<Div id='DropNote' Style='display: none;'><Small>
&raquo;
Соединение разрывается не мгновенно, а через несколько секунд. Подождите и обновите страницу
</Small></Div>
<iFrame Name='Drop' Src='0/' Style='display: none;'></iFrame>
