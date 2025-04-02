<Style><!--
Div#Listz	{
    display: none;
    padding: 0.5ex;
}
--></Style>
<Script><!--
function Listz()
{
 var z=findId('Listz');
 if(!z) return;
 z.style.display='block'==z.style.display?'none':'block';
}

function lists2str()
{
 var f=document.forms[0];
 if(!f) return;
 var S='';
 for(var i=0; i<f.length; i++)
 {
  var c=f[i];
  if(c.id.substring(0,1)!='%') continue;
  if(c.checked)
  {
   if(S.length)S+=' ';
   S+=c.id.substring(1);
  }
 }
 f.lists.value=S;
}

function str2lists()
{
 var f=document.forms[0];
 if(!f) return;
 var Z=f.lists.value.split(/\D+/);
 var X={};
 for(var i in Z)
 {
  var d=Z[i];
  if(d.length)X[d]=1;
 }
 for(var i=f.length-1; i>=0; i--)
 {
  var c=f[i];
  if(c.id.substring(0,1)!='%') continue;
  c.checked=X[c.id.substring(1)];
  c.onchange=c.onclick=lists2str;
 }
}

setInterval(str2lists, 300+100*Math.random());
//--></Script>
<FieldSet><Legend><A hRef='#' onClick='Listz(); return false;'>
Списки камер
</A></Legend>
<Div id='Listz'>
<Table Border CellSpacing='0' Width='100%'><THead><TR Class='tHeader'> 
<TH>Id<Sup></TH> 
<TH>Имя</TH> 
<TH >Камеры</TH> 
<TH >Комментарий</TH> 
</TR></THead> 
<?
$q=mssql_query('Select * From list');
while($r=mssql_fetch_object($q)):
 echo '<TR><TD Align="Right">', $r->id,
    '<BR /></TD><TD><Input Type="CheckBox" id="%', $r->id, '" /> <Label For="%', $r->id, '">',htmlspecialchars($r->name), '</Label>',
    '<BR /></TD><TD>', htmlspecialchars($r->cameras),
    '<BR /></TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "</BR></TD></TR>\n";
endwhile;
?>
</Table>
</Div>
</FieldSet>