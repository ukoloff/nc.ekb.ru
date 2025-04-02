//
// JavaScript provision for WWW RDP Access
//

function doFocus()
{
 setTimeout(function(){if(document.forms[0])document.forms[0].s.focus();}, 10);
}

function doCheck()
{
 var q=document.forms[0].s;
 var Err;
 if(q.value) return true;
 q.focus();
 findId('sError').style.display='block';
 return false;
}

function loadError()
{
 findId('noActiveX').style.display='block'; 
}

function hideBanner()
{
 findId('divLoading').style.display='none';
 var p=findId('ie7security');
 if(p)p.style.display='none';
}

function onReady()
{
 var x=findId('MsRdpClient');
 if(!x) return;
 if(x.readyState!=4) return;

 setTimeout(hideBanner, 10);

 if(!x.AdvancedSettings2)
 {
  loadError();
  return;
 }
 var b=findId('btnConnect');
 if(b) b.disabled=0; 

 if(!window.doRDP) return;
 x.attachEvent('onconnected', onConnected)
 x.attachEvent('ondisconnected', onDisconnected)
 doRDP(x);
 x.Connect();
}

function onConnected()
{
 findId('connectionOn').style.display='block';
}

function onDisconnected()
{
  location='./'+backTo;
}

//--[EOF]-------------------------------------------------------------
