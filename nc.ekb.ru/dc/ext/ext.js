function Click(No)
{
 var s=window.Txt[No];
 if(!s) return;
 var f=document.forms[0];
// f.as.value='eq';
 f.q.value=s;
 f.q.focus();
}

function Validate()
{
 var q=document.forms[0].q;
 if(q.value) return true;
 q.focus();
 return false;
}

function htmlEsc(s)
{
 var X='<lt,>gt,"quot,&amp'.split(',');
 for(var i=X.length-1; i>=0; i--)
  s=s.split(X[i].substring(0, 1)).join("&"+X[i].substring(1)+";");
 return s;
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

function Focus()
{
 document.forms[0].q.focus();
}

function tBody()
{
 var wf;
 (wf=window.opener) && (wf=wf.document.forms) && (wf=wf[0]);

 window.AttrsNo=0;

 var S='';
 for(var i=0; i<window.Attrs.length; i++)
 {
  var z=window.Attrs[i];
  S+="<TR><TD Align='Right'><B>"+htmlEsc(z.Name)+
    "</B><BR /></TD><TD>";
  if(wf)
  {
   S+="<Input Type='CheckBox' Name='n"+i+"' id='i"+i+"' ";
   if(!wf[z.Field]) S+="Disabled ";
   else window.AttrsNo++;
   S+="/><Label For='i"+i+"'>";
  }
  S+=htmlEsc(z.v);
  if(wf) S+="</Label>";
  S+="<BR /></TD></TR>\n";
 }
 document.writeln(S);
}

function enableAll()
{
 if(!window.AttrsNo) return;
 document.forms[0].All.disabled=false;
}

function checkAll(cb)
{
 var f=cb.form;
 for(var i=f.length-1; i>=0; i--)
 {
  var z=f[i];
  if('checkbox'==z.type && ! z.disabled) z.checked=cb.checked;
 }
}

function copyAll()
{
 var wf;
 if(!(wf=window.opener) || !(wf=wf.document.forms) || !(wf=wf[0])) return;
 var f=document.forms[0];
 var Case=f['case'].value;

 for(var i=window.Attrs.length-1; i>=0; i--)
 {
  var A=window.Attrs[i];
  if(!A.Field || !wf[A.Field])
    continue;  
  var z=f['n'+i];
  if(!z || !z.checked)
    continue;
  wf[A.Field].value=A['x']?A['x']:A[Case];
  z.checked=false;
 }
 f.All.checked=false;
}
