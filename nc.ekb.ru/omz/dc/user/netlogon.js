function setScript()
{
 var s=document.forms[0].scriptPath;
 s.value=document.forms[0].path.value;
 s.focus();
}

function addLine(x)
{
 if(!x.selectedIndex) return;
 var l=x.options[x.selectedIndex].value;
 x.selectedIndex=0;
 var q=x.form.Bat;
 if('^'==l.substring(0, 1))
  q.value=l.substring(1)+'\r\n'+q.value;
 else
  q.value=q.value.replace(/\s+$/, '')+'\r\n'+l+'\r\n';
 q.focus();
}
//--[EOF]-------------------------------------------------------------
