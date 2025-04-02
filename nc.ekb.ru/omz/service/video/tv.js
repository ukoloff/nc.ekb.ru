function imgTail()
{
 return ('Opera'==navigator.appName?'&':'#')+(new Date()).getTime();
}

function isActive(){}	// Заглушка

(function()
{
 var lastActive;
 var Divs={divC: 0, divTV: 0};
 isActive=function()
 {
  lastActive=(new Date()).getTime();
  for(z in Divs)
   if(Divs[z] && 'none'==findId(z).style.display)fsX(z, 42);
  for(z in Divs)Divs[z]=0;
 }
 var Check=function()
 {
  var Elapsed=(new Date()).getTime()-lastActive;
  if(Elapsed<1000*60*27) return;
  for(var z in Divs)
   if('none'!=findId(z).style.display)fsX(z, 42), Divs[z]=1;
 }
 isActive();
 setInterval(Check, 60*1000);
 document.onmousemove=isActive;
})()

function s(N)
{
 isActive();
 var URL='?jpg&w=640&n='+Cameras[N].id;
 var fUpd, fWait;
 fWait=function(){setTimeout(fUpd, 1000+2000*Math.random());}
 fUpd=function(Install)
 {
  var z
  if((z=findId('divTV')) && 'none'==z.style.display)
  {
   z.onExpand=fWait;
   return;
  }
  z=findId('tv');
  if(!z) return;
  if(42==Install)z.onload=z.onerror=fWait;
  if(z.onload!=fWait) return;
  z.src=URL+imgTail();
 }
 findId('divTV').style.display='block';
 findId('cName').innerHTML=Cameras[N].name;
 findId('cComment').innerHTML=Cameras[N].comment;
 if(findId('autoHide').checked)
 {
  findId('divC').style.display='none';
  findId('-divC').style.display='block';
 }
 fUpd(42);
}

function fsX(div, skipAct)
{
 if(42!=skipAct)isActive();
 var z=findId(div);
 var zz=findId('-'+div);
 if(!z) return;
 if('none'!=z.style.display)
 {
  z.style.display='none';
  if(zz)zz.style.display='block';
  return;
 }
 z.style.display='block';
 if(zz)zz.style.display='none';
 if(!z.onExpand) return;
 z.onExpand();
 z.onExpand=null;
}

function fsBack()
{
 fsX('divC');
 fsX('divTV');
}

function imgFail()
{
 this.src='fail.png';
}

function updThumb(N)
{
 var z=findId('thumb'+N);
 if(!z) return;
 z.onerror=imgFail;
 z.src='?jpg&w=160&n='+Cameras[N].id+imgTail();
}

// Первоначальная настройка сетки камер
(function ()
{
 var N=0, fUpd, fWait;
 fWait=function(){setTimeout(fUpd, 300+200*Math.random());};
 fUpd=function ()
 {
  updThumb(N++);
  if(N<Cameras.length) fWait();
  else refreshThumbs();
 }
 fWait();
})();

function refreshThumbs()
{
 var N=0, fUpd, fWait, isBoss=('iBoss'==document.body.className?10:1);
 fWait=function(){setTimeout(fUpd, (30*1000+10*1000*Math.random())/isBoss);};
 fUpd=function ()
 {
  var z;
  if((z=findId('divC')) && 'none'==z.style.display)
  {
   z.onExpand=fWait;
   return;
  }
  updThumb(N++);
  if(N>=Cameras.length)N=0;
  fWait();
 }
 fWait();
}

function gotoList(S)
{
 location.href='./'+(parseInt(S.value)?'?v='+parseInt(S.value):'');
}
//--[EOF]-------------------------------------------------------------
