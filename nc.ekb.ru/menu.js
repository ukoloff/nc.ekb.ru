if(window!=top)top.location.href=location.href;

GatherStatistics();

function JS(Ver)
{
 return '<'+'Script Language="JavaScript'+Ver+'">js="'+Ver+'";<'+'/Script>';
}

function wJS(Ver)
{
 if(!window.js)document.writeln(JS(Ver));
}

function oStatistics()
{
 this.js=js;
 if(js>='1.1') this.java=navigator.javaEnabled()? 'Y': 'N';
 if(!document.cookie)document.cookie="uxm=1; path=/; expires="+(new Date((new Date()).getTime()+1000)).toGMTString();
 this.cookies=!!document.cookie;
 this.TZ=(new Date()).getTimezoneOffset();
 if(window.screen)
 {
  this.w=window.screen.width;
  this.h=window.screen.height;
  if(window.screen.colorDepth) this.depth=window.screen.colorDepth;
  else if(window.screen.pixelDepth) this.depth=window.screen.pixelDepth;
 }
 if(document.layers)this.NS=1;
 X="\u0423";
 this.UTF=this.NS ||(X.length==1 && X!='#');
 if(!document.all && !document.getElementById) return;
 document.writeln("<Div id=EmptyDiv Style='display: none;'>.</Div>");
 if(document.getElementById &&(X=document.getElementById('EmptyDiv'))&& X.innerHTML) this.DOM=1;
 if(document.all &&(X=document.all.EmptyDiv)&& X.innerHTML) this.MS=1;
// return;
 this.Smart=this.MS || this.DOM;
}

function GatherStatistics()
{
 for(var n=7; n>0; n--) wJS('1.'+n);
// wJS('1.2');
// wJS('1.1');
 if(!window.js)js='1.0';
 Statistics=new oStatistics();
}

function findId(id)
{
 if(Statistics.DOM) return document.getElementById(id);
 if(Statistics.MS) return document.all[id];
// if(Statistics.NS) return document.layers[id];
 return null;
}

function AddMenu(L, Name, hRef)
{
 var c;
 var m=new Object();
 if(!window.MenuItems)MenuItems=new Array();
 MenuItems[MenuItems.length]=m;
 m.Name=Name;
 m.hRef=hRef;
 m.Level=L;
 mItem=m;
}

function menuSmart()
{
 var S='';
 var L=0;
 for(i=0; i<MenuItems.length; i++)
 {
  var m=MenuItems[i];
  while(L>m.Level)L--,S+="</Div>";
  while(L<m.Level)L++,S+="<Div Class=menuSpacer>";
  S+="<Div Class='menuItem' onMouseOver='mOver(this, "+i+")' onMouseOut='mOut(this, "+i+")'";
  if(m.title) S+=" title='"+m.title+"'";
  S+="><A hRef='"+m.hRef+"' Class='menuLink'";
  if(m.target) S+=" target='"+m.target+"'";
  S+=">"+m.Name+"</A></Div>";
 }
 while((L--)>0)S+="</Div>";
 S+="<Center><Img Src=/img/uxm.gif Alt='uxm Logo'>";
 if('/omz/'==location.pathname.substring(0, 5)) S+="<BR /><Img Src=/img/omz.gif Alt='OMZ Logo'>";
 return S+"</Center>";
}

function menuDumb()
{
 var S='';
 for(var i=0; i<MenuItems.length; i++)
 {
  var m=MenuItems[i];
  S+='<TR><TD NoWrap>';
  for(var j=m.Level; j>0; j--) S+='&nbsp;';
  S+="<A hRef='"+m.hRef+"' Class=menuLink>"+m.Name+"</A></TD></TR>";
 }
 return S;
}

function menuOuterHTML()
{
 var S='<Table id=Menu Width=0 Border CellPadding=0 CellSpacing=0 Class=menu';
 S+= Statistics.Smart ? 'Smart><TR><TD NoWrap>'+menuSmart()+'</TD></TR>' : 'Dumb Align=Left>'+menuDumb();
 S+='</Table>';
 return S;
}

function mOver(x, n)
{
 x.className='menuItemX';
// var m=MenuItems[n];
// if(m.status) window.status=m.status;
}

function mOut(x, n)
{
 x.className='menuItem';
}

function AdjustMenu()
{
// return;
 var M;
 M=findId('Menu');
 if(!M) return;
 if(M.offsetHeight<document.body.offsetHeight)
   M.style.top=document.body.scrollTop;
// M.style.width=0;
// M.style.width='';
 if(M.lastW!=M.offsetWidth)
  M.lastW=document.body.style.marginLeft=M.offsetWidth;
}

function StartUp()
{
 document.writeln(menuOuterHTML());
 if(!Statistics.Smart)return;
 AdjustMenu();
 setTimeout(AdjustMenu, 0);
 setInterval(AdjustMenu, 500);
}

function htmlEsc(s)
{
 s=''+s;
 var X='<lt,>gt,"quot,&amp'.split(',');
 for(var i=X.length-1; i>=0; i--)
  s=s.split(X[i].substring(0, 1)).join("&"+X[i].substring(1)+";");
 return s;
}

function userThumb(span, u)
{
 var x, i=document.createElement('img');
 i.className='userThumb';
 i.onload=function(){
  x=function(){
   if(!i.offsetTop) return;
   i.style.top=i.offsetTop-i.offsetHeight/2;
   x=null;
  };
  x();
 }
 i.onerror=function(){
  span.onmouseout();
  span.onmouseout=span.onmousemove=null;
 }
 span.onmouseout=function(){i.style.display='none';};
 span.onmousemove=function(){i.style.display=''; if(x) x(); }
 span.appendChild(i);
 i.src='/omz/abook/?jpg&u='+escape(u);
}

function qrPopup(A)
{
 var z=document.createElement('img');
 z.className='userThumb';
 z.onload=function(){
   if(!z.offsetTop) return;
   z.style.top=z.offsetTop-z.offsetHeight/2;
 }
 z.onerror=function(){
  A.onmouseout();
  A.onmouseout=span.onmousemove=null;
 }
 z.src=A.href;
 A.onmousemove=function(){z.style.display='';};
 A.onmouseout=function(){z.style.display='none';};
 A.parentElement.appendChild(z);
}

function startDrag(x, e)
{
 var Dragging=0, saveClass=x.className, saveMove, Delta;

 x.onmousedown=onDown;
 x.onmouseup=onUp;
 onDown(e);

 function getPos(e)
 {
  if(document.attachEvent)	// Internet Explorer & Opera
  return {
   x: window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft,
   y: window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop
  };
 if(document.addEventListener)	// Gecko
  return {x: e.clientX + window.scrollX, y: e.clientY + window.scrollY};
 }

 function onDown(e)
 {
  if(Dragging) return;
  Dragging=1;
  saveMove=document.onmousemove;
  document.onmousemove=onMove;
  x.className+=' dragging';
  Delta=getPos(e);
  Delta.x-=x.offsetLeft;
  Delta.y-=x.offsetTop;
  if(e && e.preventDefault) e.preventDefault();
 }
 function onUp()
 {
  Dragging=0;
  document.onmousemove=saveMove;
  x.className=saveClass;
 }
 function onMove(e)
 {
  var P=getPos(e);
  x.style.left = P.x-Delta.x;
  x.style.top  = P.y-Delta.y;
//  if(e)e.cancelBubble=true;
//  if(e && e.preventDefault) e.preventDefault();
  return false;
 }
}

function hideRemainder(A)
{
 A.parentElement.style.display='none';
}

//--[EOF]------------------------------------------
