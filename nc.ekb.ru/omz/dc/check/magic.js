location.href='?'+Redirect();

function Redirect()
{
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
  if(p&&(v=f[v])) return p+'='+myEscape(v.value); 
 }
 return 'oops';
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
//--[EOF]-------------------------------------------------------------
