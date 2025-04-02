//
// AJAX user check
//

var aj;

function ajaxInit()
{
 if(!document || !document.getElementById) return;
 if(!Ajax()) return;
 aj={u: document.forms[0].u};
 aj.last=aj.u.value;
 var x=document.createElement('span');
 aj.u.parentNode.insertBefore(x, aj.u.nextSibling);
 x.className='Ajax';
 aj.Status=x;
 setInterval(ajProcess, 500);
// alert('Hi!');
}

function Ajax()
{
 var e;
 try{ return new XMLHttpRequest();}catch(e){};
 try{ return new ActiveXObject("Msxml2.XMLHTTP");;}catch(e){};
 try{ return new ActiveXObject("Microsoft.XMLHTTP");;}catch(e){};
}

function Nop()
{
}

function trim(S)
{
 return S.replace(/^\s+/, '').replace(/\s+$/, '');
}

function ajReady()
{
 if(4!=aj.h.readyState) return;
 aj.h.onreadystatechange=Nop;
 aj.Status.innerHTML=aj.h.responseText;
 delete aj.h;
}

function ajProcess()
{
 var v=trim(aj.u.value);
 if(v==aj.last) return;
 aj.last=v;
// aj.Status.innerHTML=v;
 if(aj.h)
 {
  aj.h.onreadystatechange=Nop;
  aj.h.abort();
  delete aj.h;
 }
 aj.Status.innerHTML='';
 if(!v.length) return;
 aj.h=Ajax();
 aj.h.open("GET", "../check/ajax/?u="+encodeURIComponent(v), true);
 aj.h.onreadystatechange=ajReady;
 aj.h.send(null);
}

setTimeout(ajaxInit, 1);

//--[EOF]--------------------------------------------------------------
