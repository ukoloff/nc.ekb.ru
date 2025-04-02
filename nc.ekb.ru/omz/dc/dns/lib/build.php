<?
dnsTree('uxm');
dnsTree('ekb.ru');
dnsTree('uralhimmash.ru');
#dnsTree('wpad');
#dnsTree('wpad.com');

// ptrRecords();
// ^ Limited to 1000 records :-(

$CFG->Tree=buildTree($CFG->RRs);

function dnsTree($Root)
{
 global $CFG;
 $q=ldap_search($CFG->AD->h, "DC=$Root,CN=MicrosoftDNS,CN=System,".$CFG->AD->baseDN, '(objectClass=dnsNode)');
 for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
  $dc=ldap_get_values($CFG->AD->h, $e, 'dc');
  $dc=$dc[0];
  if (substr($dc, -1) == '.') continue;
  $x=ldap_get_values_len($CFG->AD->h, $e, 'dnsRecord');
  for($i=$x['count']-1; $i>=0; $i--):
    $RR=unpack('vlen/vtype/V5/a*Data', $x[$i]);
    switch($RR['type']){
     case 1: $RRT='A'; $Value=join('.', unpack('C4', $RR[Data])); break;
     case 5: $RRT='CNAME'; $Value=parseHost($RR[Data]); break;
     case 0x21: $RRT='SRV'; $Value=parseSRV($RR[Data]); break;
     default: $RRT='-';
    }
    if('-'==$RRT) continue;
   unset($it);
   $it->dc=('@'==$dc? '' : $dc.".").$Root;
   $it->RR=$RRT;
   $it->Value=$Value;
   $it->r = 1;		// Regular, chain in order
//    $it->z = $RR;
//    $it->x = $dc;
   $CFG->RRs[]=$it;
  endfor;
 endfor;
}

function ptrRecords() {
 global $CFG;
 unset($zones);
 $q=ldap_list($CFG->AD->h, "CN=MicrosoftDNS,CN=System,".$CFG->AD->baseDN, '(&(objectClass=dnsZone)(DC=*.in-addr.arpa))', Array('dc'));
 for($e=ldap_first_entry($CFG->AD->h, $q); $e; $e=ldap_next_entry($CFG->AD->h, $e)):
   $dc = ldap_get_values($CFG->AD->h, $e, 'dc');
   unset($z);
   $z->dc = preg_replace('/([.][^.]*){2}$/', '', $dc[0]);
    // implode('.', array_slice(array_reverse(explode('.', $dc[0])), 2));
   $z->dn = ldap_get_dn($CFG->AD->h, $e);
   $zones[] = $z;
 endfor;
 ldap_free_result($q);
 foreach ($zones as $z):
   $q=ldap_search($CFG->AD->h, $z->dn, '(objectClass=dnsNode)'); //, null, 0, 0);
   for($e = ldap_first_entry($CFG->AD->h, $q); $e; $e = ldap_next_entry($CFG->AD->h, $e)):
     $dc = ldap_get_values($CFG->AD->h, $e, 'dc');
     $dc = $dc[0] . "." . $z->dc; // . "." . implode('.', array_reverse(explode('.', $dc[0])));
     $x = ldap_get_values_len($CFG->AD->h, $e, 'dnsRecord');
     for($i = $x['count']-1; $i>=0; $i--):
       $RR=unpack('vlen/vtype/V5/a*Data', $x[$i]);
       if ($RR['type'] != 12) continue;
       unset($it);
       $it->dc = $dc; //implode('.', array_reverse(explode('.', $dc)));
       $it->Value = parseHost($RR['Data']);
       $it->RR = 'PTR';
       //$it->x = $dc;
       $CFG->RRs[] = $it;
     endfor;
   endfor;
   ldap_free_result($q);
 endforeach;
}

function parseHost($S)
{
 $Z=unpack('C/CCount/a*Names', $S);
 $S=$Z[Names];
 $R='';
 for($i=$Z[Count]; $i>0; $i--):
  $R.=substr($S, 1, ord($S{0})).'.';
  $S=substr($S, 1+ord($S{0}));
 endfor;
 return substr($R, 0, -1);
}

function parseSRV($S)
{
 $Z=unpack('nPri/nWeight/nPort/a*Host', $S);
 return "$Z[Pri] $Z[Weight] $Z[Port] ".parseHost($Z[Host]);
}

function dnscmp($a, $b)
{
# $R=strcasecmp($a->key, $b->key);
# if($R) return $R;
 $R=strcasecmp($a->RR, $b->RR);
 if($R) return $R;
 return strcasecmp($a->Value, $b->Value);
}

function cmpRR($a, $b)
{
 $R=strcasecmp($a->RR, $b->RR);
 if($R) return $R;
 return strcasecmp($a->Value, $b->Value);
}

function dcCmp($a, $b) {
  return preg_match('/^\d+$/', $a) && preg_match('/^\d+$/', $b) ?
    (int)$a - (int)$b
    :
    strcasecmp($a, $b);
}

function sortLeaf(&$R)
{
 if($R->RRs)
  uasort($R->RRs, cmpRR);
 if(!$R->sub) return;
 uksort($R->sub, dcCmp);
 foreach($R->sub as $z)
   sortLeaf($z);
}

function numTree(&$R, $N=0)
{
 $R->no=++$N;
 if($R->sub)
  foreach($R->sub as $r)
   $N=numTree($r, $N);
 return $N;
}

function buildTree($RRs)
{
// $R=newLeaf();
 foreach($RRs as $r):
  $leaf=&$R;
  foreach(array_reverse(explode('.', $r->dc)) as $dc):
   if(!$leaf->sub[$dc]):
    unset($x);
    $x->dc=$dc;
    $x->path = $leaf->path ?
	$r->r ?
	  $dc . '.' . $leaf->path
	  :
	  $leaf->path . '.' . $dc
	: $dc;
    $leaf->sub[$dc]=$x;
   endif;
   $leaf=&$leaf->sub[$dc];
  endforeach;
  unset($x);
  $x->RR=$r->RR;
  $x->Value=$r->Value;
  $leaf->RRs[]=$x;
 endforeach;

 sortLeaf($R);
 numTree($R);

 return $R;
}

function hex($S)
{
 $x=unpack('H*', $S);
 return $x[1];
}

?>
