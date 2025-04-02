function Toggle(N)
{
 var z=findId('p'+N);
 var zx=findId('x'+N);
 if(!z) return;
 if('+'==z.innerText)
 {
  z.innerText='-';
  zx.style.display='block';
 }
 else
 {
  z.innerText='+';
  zx.style.display='none';
 }
}
