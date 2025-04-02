function HideLinks()
{
 var x=findId('Data');
 if(!x) return;
 if(Statistics.DOM) x=x.getElementsByTagName('A');
 else if(Statistics.MS) x=x.all.tags('A');
 else return;
 if(!x) return;
 for(i=x.length-1; i>=0; i--)
  x[i].outerHTML=(x[i].className!='Sort')? x[i].innerHTML : '';
}
