function addFilter()
{
 var f=document.forms[0];
 findId('whenEmpty').style.display='none';
 findId('whenFiltering').style.display='block';
 var d=document.createElement('div');
 findId('Filters').appendChild(d);
 d.innerHTML=findId('emptyFilter').innerHTML;
}

function removeFilter(A)
{
 var d=A.parentNode;
 var z=d.parentNode;
 z.removeChild(d);
 if(z.firstChild) return;
 findId('whenEmpty').style.display='';
 findId('whenFiltering').style.display='';
}

function buildFilter(f)
{
 var z=f.children[0];
 var S='';
 for(var i=z.children.length-1; i>=0; i--)
 {
  var x=z.children[i];
  var a=x.getElementsByTagName('select'), b=x.getElementsByTagName('input');
  if(!a[0].value) continue;
  if(S.length)S+=';';
  S+=a[0].value;
  if(b[0].checked)S+='!';
  S+=a[1].value;
  if(/^[-@]$/.test(a[1].value)) continue;
  S+=b[1].value.replace(/[\\;]/g, '\\$&');
 }
 if(!S.length) return false;
 f.q.value=S;
}

function crtLink(TD)
{
 var z=TD.children[0];
 if('crtLink'!=z.className) return;
 TD.onmousemove=function(){z.style.display='block';}
 TD.onmouseout=function(){z.style.display='';}
}
