<?
require('../../lib/uxm.php');


uxmHeader('AJAX test');
?>
<H1>AJAX test</H1>
<Script><!--
var Z=Ajax();

if(!Z) document.writeln('AJAX not working :-(');

Z.open('GET', '../krb/', true);
Z.onreadystatechange=Got;
Z.send(null);
setTimeout(timeOff, 1000);

function Ajax()
{
 var e;
 try{ return new XMLHttpRequest();}catch(e){};
 try{ return new ActiveXObject("Msxml2.XMLHTTP");;}catch(e){};
 try{ return new ActiveXObject("Microsoft.XMLHTTP");;}catch(e){};
}

function Got()
{
 if(4!=Z.readyState) return;

 var ZZ=Z;
 Z=null;
 findId('X1').innerText=ZZ.responseText;
}

function timeOff()
{
 if(!Z) return;
 Z.abort();
 findId('X2').innerText='Timeout';
}
//--></Script>

<LI>Response: <Span id='X1'></Span>
<LI>Error: <Span id='X2'></Span>

</body></html>
