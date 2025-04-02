//
// Push EventLog to WWW
//

WScript.Interactive=false;

var R='';
for(var i=WScript.Arguments.length-1; i>=0; i--)
{
 if(!WScript.Arguments(i).match(/^(\w+):(.+)$/)) continue;
 R+=(R.length?'&':'?')+escape(RegExp.$1)+'='+escape(RegExp.$2);
}
WScript.Echo(R);
if(!R.length) WScript.Quit();

var Ajax=new ActiveXObject("Msxml2.XMLHTTP");
Ajax.open('GET', 'https://ekb.ru/omz/stat/TSG/'+R, false);
Ajax.send();
