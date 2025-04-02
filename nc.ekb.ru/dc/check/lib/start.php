<Script><!--
if((f=window.opener)&&(f=f.document)&&(f=f.forms)&&(f=f[0])&&(x=f.x)&&(v=x.value))
{
 switch(v)
 {
  case 'new':
    p='u'; v='u'; break;
  case 'groups':
    p='g'; v='add'; break;
  case 'list':
    p='ug'; v='add'; break;
 }
 if(p&&(v=f[v])) location.href='?'+p+'='+myEscape(v.value);
}

function myEscape(S)
{
 var X='%|+%2B| +|&|=|;|#'.split('|');
 for(var i=0; i<X.length; i++)
 {
  c=X[i];
  v=c.substring(1);
  c=c.substring(0, 1);
  if(!v)v=escape(c);
  S=S.split(c).join(v);
 }
 return S;
}

//--></Script>
<H1>Проверка</H1>
<P>Если Вы видите этот текст - значит чего-то не сработало :-(
</P>

