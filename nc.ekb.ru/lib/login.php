<?	// ��������� login-script'� ��� ������

function echoLoginScript($u)
{
 if(!$u) return;
 $udn=user2dn($u);
 if(!$udn) return;

 Header("Content-type: text/plain");

// �������� �������������
 $dn=new dn($udn);
 for($pdn=new dn(''); count($pdn->X)<count($dn->X); array_unshift($pdn->X, $dn->X[count($dn->X)-count($pdn->X)-1]))
  putScript($pdn->str());
 unset($dn); unset($pdn);

// �������� �����
 $X=Array();		// ������� ������ �������������� �����
 $dns=Array();		// ������ ���� �����
 $newdns=Array();	// ������ �������������� �����
 $dn=$udn;
 unset($child);
 while(true):
  $e=getEntry($dn, 'memberOf');
  $e=$e[$e[0]];
  for($ii=$e['count']-1; $ii>=0; $ii--):
   $gdn=$e[$ii];
   $n=$dns[$gdn];
   if(!$n):
    $dns[$gdn]=$n=1+count($dns);
    $newdns[]=$gdn;
    $X[$n]=Array();
   endif;
   if(!$child or $child==$n or $X[$child][$n])
    continue;
   $X[$child][$n]=1;						// ��������� ������� ��������������
   foreach($X[$n] as $i=>$Y) $X[$child][$i]=1;			// ������ $n - ������ $child
   foreach($X as $i=>$Y) if($X[$i][$child]) $X[$i][$n]=1;	// ������� $child - ������� $n
   foreach($X as $i=>$Y):					// ������������ ������� $X
    unset($X[$i][$i]);						// ������ �� ��������� ����
    foreach($X[$i] as $j=>$Z):
     if(!$X[$j][$i]) continue;
     unset($X[$j]);						// ������ $i � $j ������������, ����������� $j
     foreach($X as $k=>$ZZ) unset($X[$k][$j]);
     foreach($dns as $adn=>$m)
      if($m==$j) $dns[$adn]=$i;					// ������ ����� $j--->$i
    endforeach;
   endforeach;
  endfor;

// ������� ��� ������, ���� ������ $dn. �������� ���� �� ��� � ���� � ���-������
  $dn=array_pop($newdns);
  if(!isset($dn)) break;						// ������ ����� �� ��������
  $child=$dns[$dn];
 endwhile;
// ������ � $X - ������ ������� �������������� �����
// ��� ������ �������� �� �� ��������� �������������� (���� � ������ ������ ��� �� �����������)
 foreach($X as $i=>$Y)
  foreach($X as $j=>$Z)
   if($X[$j][$i])
    foreach($X[$i] as $k=>$ZZ) unset($X[$j][$k]);		// $j<$i<$k, ������ $j<$k - �������� ������������
// ������ �������� DN ����� � �������� ������������� �����
 foreach($dns as $dn=>$n) $newdns[$n][]=$dn;
 unset($dns);
 while(count($X)>0):
  foreach($X as $i=>$Y):
   if(count($X[$i])>0) continue;					// � ������ $i ���� ������, � - �����
   if(is_array($newdns[$i]))foreach($newdns[$i] as $dn)
    putScript($dn);
   unset($newdns[$i]);
   unset($X[$i]);						// ����������� ������ $i
   foreach($X as $j=>$Z) unset($X[$j][$i]);
  endforeach;
 endwhile;

// ������ �������� ������������
 putScript($udn);
}

// Login Script ������� AD
function putScript($dn)
{
 $e=getEntry($dn, 'desktopProfile');
 $S=utf2str($e[$e[0]][0]);
 if(!$S) return;
 $ufn=new dn($dn);
 $ufn=$ufn->ufn();
 echo "@REM Script: ", $ufn->str(), "\n$S\n\n";
}

?>
