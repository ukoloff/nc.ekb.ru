<?
//ini_set("display_errors", 1);

require("../../lib/uxm.php");

uxmHeader('Екатеринбургское время');
?>
<Style><!--
Div#Q	{
    position: absolute;
    left: -5cm;
    top: -5cm;
    width: 5cm;
    height: 5cm;
    x-border: 1px solid red;
}

Table#Clock {
    width: 100%;
    height: 100%;
}

Div#Canvas {
    position: absolute;
    x-left: 0;
    x-top: 0;
    x-width: 100%;
    x-height: 100%;
    x-border: 1px solid green;
}

Form {
    x-border: 1px solid navy;
}

--></Style>
<Table id='Clock' onResize='Update(1)'><TR><TD Align='Center'>
<Div id='Canvas'></Div>
<Div id='Q'></Div>
<Form>
Дата<BR />
<Input Name='d' Size='11' ReadOnly />
<P>
Время<BR />
<Input Name='t' Size='8' ReadOnly />
</Form>
</TD></TR></Table>
<Script><!--
//if(Statistics.DOM) document.writeln("<"+"Script Src='wz_jsgraphics.js'><"+"/"+"Script>")

var LastSec=-1;
var DateDiff=(new Date(<?=
strtr(strftime("%Y, %m-1, %d, %H, %M, %S"), Array(', 0'=>', '))?>, <?=
preg_replace('/\s.*/', '', microtime())?>)).getTime()-
    (new Date()).getTime();

function Init()
{
 var Q=document.getElementById('Q');
 document.getElementById('z').innerHTML=Q.offsetWidth+'x'+Q.offsetHeight;
}

Number.prototype.N2=function()
{
 var S=this.toString();
 if(1==S.length) S='0'+S;
 return S;
}

var Graph;

function Update(Force)
{
 var D=new Date((new Date()).getTime()+DateDiff);
 if(!Force && D.getSeconds()==LastSec) return;
 LastSec=D.getSeconds();
 var z=document.forms[0].d;
 var s=D.getDate()+' '+("янв,фев,мар,апр,май,июн,июл,авг,сен,окт,ноя,дек").split(',')[D.getMonth()]+' '+D.getFullYear();
 if(z.value!=s) z.value=s;
 z=document.forms[0].t.value=D.getHours().N2()+':'+D.getMinutes().N2()+':'+D.getSeconds().N2();

 if(!Statistics.DOM) return;

 var T=findId("Clock");
 var C=findId("Canvas");
 C.style.top=T.offsetTop;
 C.style.left=T.offsetLeft;
 C.style.width=T.offsetWidth;
 C.style.height=T.offsetHeight;

 return;
 if(Graph)
  Graph.clear()
 else
  Graph=new jsGraphics(C);
// return;
// alert(Z);
// Z.clear();
// Z.setColor("red");
 Graph.drawLine(0, 0, C.offsetWidth/2, C.offsetHeight/2);
 Graph.drawEllipse(0, 0, C.offsetWidth/2, C.offsetHeight/2);
 Graph.paint();
}

//setTimeout(Init, 1);

setInterval(Update, 100);

//--></Script>
</body></html>
