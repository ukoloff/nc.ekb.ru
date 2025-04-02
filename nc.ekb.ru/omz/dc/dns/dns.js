function flip(N, A)
{
 var x=A.innerHTML;
 if('+'==x) x=0;
 else if('-'==x) x=1;
 else return;
 A.innerHTML=x?'+':'-';
 findId('*'+N).style.display=x?'':'block';
}
