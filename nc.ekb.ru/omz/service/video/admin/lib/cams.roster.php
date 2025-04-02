<Style><!--
Div#camList	{
    display: none;
    padding: 0.5ex;
}
--></Style>
<Script><!--
function camList()
{
 var z=findId('camList');
 if(!z) return;
 z.style.display='block'==z.style.display?'none':'block';
}

function cameraThumb(TD)
{
 if(!TD.getElementsByTagName('img').length)
 {
  var z=document.createElement('img');
  z.className='userThumb';
  z.src='./?jpg&w=160&n='+TD.innerHTML;
  TD.appendChild(z);
  TD.onmouseout=function(){z.style.display='none';};
 }
 TD.getElementsByTagName('img')[0].style.display='inline';
}

function check2str()
{
 var f=document.forms[0];
 if(!f) return;
 var S='', Empty=0;
 for(var i=0; i<f.length; i++)
 {
  var c=f[i];
  if(c.id.substring(0,1)!='*') continue;
  if(c.checked)
  {
   if(S.length)S+=' ';
   S+=c.id.substring(1);
  }
  else Empty++;
 }
 if(0==Empty) S='';
 else if(0==S.length) S='0';
 f.cameras.value=S;
}

function str2check()
{
 var f=document.forms[0];
 if(!f) return;
 if(!f.cameras.onfocus)f.cameras.onfocus=function()
 {
  if(arguments.callee.called) return;
  arguments.callee.called=1;
  var z=findId('camList');
  if(!z) return;
  z.style.display='block';
 }

 var Z=f.cameras.value.split(/\D+/);
 var X={};
 for(var i in Z)
 {
  var d=Z[i];
  if(d.length)X[d]=1;
 }
 var isEmpty=1;
 for(var i in X){isEmpty=0; break;}

 for(var i=f.length-1; i>=0; i--)
 {
  var c=f[i];
  if(c.id.substring(0,1)!='*') continue;
  c.checked=(isEmpty||X[c.id.substring(1)]);
  c.onchange=c.onclick=check2str;
 }
}

function cFilter(s)
{
 var X=findId('@*'), Y;
 if(!X) return;
 X=X.rows;
 s=s.value;
 if(s.length)
 {
  Y={};
  s=s.split(',');
  for(var i in s) Y['@'+s[i]]=1;
 }
 for(var i in X)
 {
  var r=X[i];
  r.style.display=(!Y || Y[r.id])?'':'none';
 }
}

setInterval(str2check, 300);
//--></Script>
<FieldSet><Legend><A hRef='#' onClick='camList(); return false;'>
Камеры
</A></Legend>
<Div id='camList'>
<Div Align='Right'>
<? LoadLib('cam.filter'); ?>
</Div>
<Table Border CellSpacing='0' Width='100%'><THead><TR Class='tHeader'> 
<TH>!</TH> 
<TH>Id</TH> 
<TH >Имя</TH> 
<TH >Комментарий</TH> 
</TR></THead> 
<TBody id="@*">
<?
$q=mssql_query('Select * From cam');
while($r=mssql_fetch_object($q)):
 echo '<TR id="@', $r->id, '"><TD Align="Center">', $r->skip?'#':'', '<BR /></TD><TD Align="Right" Class="id" onMouseMove="cameraThumb(this)">', $r->id,
    '<A hRef="./', htmlspecialchars(hRef('x', 'camera', 'i', $r->id)), '" Target="camera">&raquo;</A>',
    '<BR /></TD><TD><Input Type="CheckBox" id="*', $r->id, '" /> <Label For="*', $r->id, '">',htmlspecialchars($r->name), '</Label>',
    '</TD><TD><i>', htmlspecialchars($r->comment), '</i>',
    "</BR></TD></TR>\n";
endwhile;
?>
</TBody></Table>
</Div>
</FieldSet>
