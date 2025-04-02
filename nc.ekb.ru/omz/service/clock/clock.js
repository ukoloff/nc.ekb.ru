Number.prototype.N2=function()
{
 var S=this.toString();
 if(1==S.length) S='0'+S;
 return S;
}
setTimeout(function()
{
 if(!Statistics.DOM) return;
 var z=findId('#1');
 var c=document.createElement('canvas');
 document.body.appendChild(c);
 var e;
 try{G_vmlCanvasManager.initElement(c);}catch(e){};
 var sec=-1;
 window.onresize=function(){sec=-1;};
 setInterval(function()
 {
  var D=new Date((new Date()).getTime()+DateDiff);
  if(D.getSeconds()==sec) return;
  sec=D.getSeconds();
  findId('date').innerHTML=D.getDate().N2()+'/'+(1+D.getMonth()).N2()+'/'+D.getFullYear();
  findId('time').innerHTML=D.getHours().N2()+':'+D.getMinutes().N2()+':'+D.getSeconds().N2();

  var W=z.offsetWidth, H=z.offsetHeight;
  c.width=W;
  c.height=H;
  c.style.left=z.offsetLeft+'px';
  c.style.top=z.offsetTop+'px';

  var az=findId('Aspect'), Rx=W/2, Ry=H/2;
  if(Rx/az.offsetWidth>Ry/az.offsetHeight)
    Rx=Ry/az.offsetHeight*az.offsetWidth;
  else
    Ry=Rx/az.offsetWidth*az.offsetHeight;

  var x=c.getContext('2d');
  var sin, cos;

  function Angle(fi)
  {
   fi*=Math.PI/30;
   sin=Math.sin(fi);
   cos=Math.cos(fi);
  }

  function goTo(x0, y0, Start)
  {
   var i=(x0*cos+y0*sin)*Rx+W/2, j=(x0*sin-y0*cos)*Ry+H/2;
   if(Start) x.moveTo(i, j);
   else x.lineTo(i, j);
  }
  
  x.strokeStyle='#000000';
  x.beginPath();
  Angle(sec);
  goTo(0, 0, 1); goTo(0, 1);
  x.stroke();

  Angle(D.getMinutes());
  x.beginPath();
  var hw=0.015, hl=0.9;
  goTo(-hw, -hw, 1); goTo(0, hl); goTo(hw, -hw);
  x.closePath();
  x.stroke();

  Angle(5*D.getHours()+D.getMinutes()/12);
  hw=0.02; hl=0.61;
  goTo(-hw, -hw, 1); goTo(-hw, hl); goTo(hw, hl); goTo(hw, -hw);
  x.closePath();
  x.stroke();
 }, 100);
}, 0);
