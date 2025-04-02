function Ajax()
{
 var e;
 try{ return new XMLHttpRequest();}catch(e){};
 try{ return new ActiveXObject("Msxml2.XMLHTTP");;}catch(e){};
 try{ return new ActiveXObject("Microsoft.XMLHTTP");;}catch(e){};
}

function e(S)
{
 return document.getElementById(S);
}

var z, stime, hInterval, stage, blob, bytes, ulsz;

function Start(A)
{
 e('Start').style.display='none';
 e('speed0').innerHTML='';
 e('speed1').innerHTML='';
 stage=0;
 bytes=0;
 stime=(new Date()).getTime();
 hInterval=setInterval(showTime, 100);

 DL(Math.round(10000+5000*Math.random()));
}

function Elapsed()
{
 return ((new Date()).getTime()-stime)/1000;
}

function showTime()
{
 e('time'+stage).innerHTML=Elapsed().toFixed(1)+' s';
}

function DL(sz)
{
 z=Ajax();
 z.onreadystatechange=gotDL;
// z.open('GET', 'data/?n='+sz+'&'+(new Date()).getTime(), true);
// z.send(null);
 z.open('POST', 'data/', true);
 z.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 z.send('n='+sz);
}

function gotDL()
{
 if(4!=z.readyState) return;
 blob=z.responseText;
 var sz=blob.length;
 bytes+=sz;
 if((bytes<10000000) && Elapsed()<3)
  return DL(Math.round(sz*((sz>1000000?0:1)+0.9+0.2*Math.random())));

 showSpeed();
 stage=1;
 bytes=0;
// blob='r='+blob.replace('&', '*');
 stime=(new Date()).getTime();

 UL(Math.round(10000+5000*Math.random()));
}

function showSpeed()
{
 e('time'+stage).innerHTML='';
 var x=e('speed'+stage), s=bytes/Elapsed();
 x.title=s.toFixed(0)+' b/s';
 x.innerHTML=(s/(1024/8)/1024).toPrecision(4)+' Mbit/s';
}

function UL(sz)
{
 ulsz=blob.length;
 if(ulsz>sz) ulsz=sz;
 z=Ajax();
 z.onreadystatechange=gotUL;
 z.open('POST', 'data/', true);
 z.setRequestHeader("Content-type", "application/octet-stream");
 z.send(blob.substring(0, ulsz));
}

function gotUL()
{
 if(4!=z.readyState) return;
 bytes+=ulsz;
 if((bytes<10000000) && Elapsed()<3)
  return UL(Math.round(ulsz*((ulsz>1000000?0:1)+0.9+0.2*Math.random())));

 blob=null;
 clearInterval(hInterval);
 showSpeed();
 e('Start').style.display='';
 e('Again').style.display='';
}

//--[EOF]-------------------------------------------------------------
