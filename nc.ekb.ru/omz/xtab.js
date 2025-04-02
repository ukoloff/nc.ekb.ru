setTimeout(function(){

var Menu=document.getElementsByTagName('table');
for(var i in Menu) if(Menu[i].className=='Tabs'){T=Menu[i]; break;}
if(!T) return;
T=T.rows[0];
if(T.cells.length!=1) return;
if('Tabs'!=T.className) return;
T=T.cells[0].getElementsByTagName('tr');
if(1!=T.length) return;
T=T[0].cells;
if(T.length<6) return;
var N=0, L=-1, R=Math.floor(T.length/2)-1;
for(i=1; i<T.length; i+=2)
 if(T[i].className=='Active')
 {
  if(L>=0) return;
  L=(i-1)/2;
  R-=L;
 }
 else if(T[i].className!='Passive') return;
if(L<0) return;

function tabN()
{
 var i=Math.round((N-1)*L/(L+R));
 return i==Math.round(N*L/(L+R))? 1+L+R-N+i : i;
}

Menu=document.createElement('div');

function opera9fix()
{
 if(!window.opera) return;
 var z=T[T.length-1];
 z.style.display='none';
 z.style.display='';
 z.className=z.className;
}

function Inc()
{
 if(N>=L+R) return;
 N++;
 var z=tabN();
 var x=T[1+2*z];
 Menu.appendChild(x.firstChild);
 Menu.appendChild(document.createElement('br'));
 if(N>1)
 {
  x.style.display='none';
  T[2*z].style.display='none';
  opera9fix();
 }
 else
 {
  var Div=x.appendChild(document.createElement('div'));
  Div.className=z?'Right':'Left';
  Div.innerHTML=z?'&raquo;':'&laquo';
  Div.appendChild(Menu);
  x.onmouseover=function(){ Menu.style.display='block'; }
  x.onmouseout=function(){Menu.style.display='';}
 }
}

function Dec()
{
 if(N<=0) return;
 var z=tabN();
 N--;
 var x=T[1+2*z];
 if(N)
 {
  T[2*z].style.display='';
  x.style.display='';
  opera9fix();
 }
 else
 {
  x.firstChild.removeChild(Menu);
  x.innerHTML='';
  x.onmouseover=null;
  x.onmouseout=null;
 }
 Menu.removeChild(Menu.lastChild);
 x.appendChild(Menu.lastChild);
}

var lastW=-1;
function setWidth()
{
 var eol=T[T.length-1];
 if(eol.offsetWidth==lastW) return;
 var sp=T[2*L];
 while((N>0) && (sp.offsetWidth<=eol.offsetWidth)) Dec();
 while((N<L+R) && (sp.offsetWidth>eol.offsetWidth)) Inc();
 lastW=eol.offsetWidth;
}

setWidth();
setInterval(setWidth, 365);

}, 100);

//--[EOF]-------------------------------------------------------------
