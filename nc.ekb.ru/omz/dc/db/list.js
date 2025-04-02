function Click(No)
{
 var s=window.Txt[No];
 if(!s) return;
 var f=document.forms[0];
// f.as.value='eq';
 f.q.value=s;
 f.q.focus();
}

function Hints()
{
 var x=window.opener;
 if(!x || !(x=x.document.forms) || !(x=x[0])) return;
 var S='';
 var No=0;
 window.Txt=Array();
 for(i=0; i<x.length; i++)
 {
  var n=x[i];
  var y;
  if('text'!=n.type || !(y=n.value)) continue;
  for(var j=window.Txt.length-1; j>=0; j--)
   if(y==window.Txt[j]) { y=''; break; }
  if(!y) continue;
  S+="&raquo;<A hRef='./#' onClick='Click("+No+"); return false;'>"+htmlEsc(y)+"</A>\n";
  window.Txt[No++]=y;
 }
 document.writeln(S);
}

setTimeout(function(){if((q=document.forms[0]) && (q=q.q) && !q.value.length)q.focus();}, 0);

function Validate()
{
 var q=document.forms[0].q;
 if(q.value) return true;
 q.focus();
 return false;
}

function userThumb(TD, href)
{
 if(!TD.getElementsByTagName('img').length)
 {
  if((new Date()).getTime()<Statistics.stopThumbs) return;
  var z=document.createElement('img');
  z.className='userThumb';
  z.src=href;
  TD.insertBefore(z, TD.firstChild);
  TD.onmouseout=function(){z.style.display='none';};
  z.onerror=function(){TD.onmouseout(); TD.onmouseout=TD.onmousemove=null;}
  Statistics.stopThumbs=(new Date()).getTime()+300+200*Math.random();
 }
 TD.getElementsByTagName('img')[0].style.display='inline';
}

//--[EOF]-------------------------------------------------------------
