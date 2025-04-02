function tBody()
{
 var wf;
 (wf=window.opener) && (wf=wf.document.forms) && (wf=wf[0]);

 window.AttrsNo=0;

 var S='';
 for(var i=0; i<Attrs.length; i++)
 {
  var z=Attrs[i];
  var cb=wf? (wf[z.t]?1:-1):0;
  if(cb>0)window.AttrsNo++;
  S+="<TR><TD Align='Right' NoWrap>";
  if(cb) S+="<Label For='*"+i+"'>";
  S+='<b>'+htmlEsc(z.n)+'</b>';
  if(cb)
  {
   S+="</Label> <Input Type='CheckBox' Name='*"+i+"' id='*"+i+"' ";
   if(cb<0) S+='Disabled ';
   S+='/>'
  }
  S+="<BR /></TD><TD><Div Style='position: relative;'>"+
    (z.jpg? '+<img src="'+htmlEsc(z.jpg)+'" class="Draggable" onmousedown="startDrag(this, event)" />' : htmlEsc(z.v));
  if(z.w) S+=' <A hRef="'+htmlEsc(z.w)+'">&raquo;</A>';
  S+="<BR /></Div></TD></TR>\n";
 }
 document.writeln(S);
}

function enableAll()
{
 if(!window.AttrsNo) return;
 document.forms[0]['**'].disabled=false;
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
 (wf=window.opener) && (wf=wf.document.forms) && (wf=wf[0]);
 if(!wf) return;

 var f=document.forms[0];
 var Case=f['case'].value;

 for(var i=window.Attrs.length-1; i>=0; i--)
 {
  var A=window.Attrs[i];
  if(!A.t || !wf[A.t])
    continue;  
  var z=f['*'+i];
  if(!z || !z.checked)
    continue;
  wf[A.t].value=A[Case]||A.v;
  z.checked=false;
 }
 f['**'].checked=false;
}

//--[EOF]-------------------------------------------------------------
