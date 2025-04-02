setTimeout(function()
{
 var z=findId('sumPopup');
 var x=z.parentNode;
 x.style.position='relative';
 window.iFrameReady=function(d)
 {
  z.innerHTML=d.body.innerHTML;
  d.body.innerHTML='';
 }
 x.onmouseover=function()
 {
  z.style.display='block';
 }
 x.onmouseout=function()
 {
  z.style.display='none';
 }
}, 0);
