<?
$CFG->months3=explode(' ', '€нв. фев. март апр. май июнь июль авг. сент. окт. но€. дек.');
//$CFG->months3=explode(' ', '€нварь февраль март апрель май июнь июль август сент€брь окт€брь но€брь декабрь');

class monthIterator
{
 function monthIterator($min, $max)
 {
  $this->min=$min;
  $this->max=$max;
  if($this->Done=($min>$max or $max==0)) return;
  echo "<Table Class='Summary' Border CellSpacing='0'>\n";
  $this->TR();
  $this->year=(int)substr($max, 0, 4);
  $this->month=0;
 }

 function Advance()
 {
  global $CFG;
  if($this->Done) return;
  if($this->Open) echo "</TD>\n";
  $this->Open=true;
  if(++$this->month > 12):
   echo "<TH>", $this->year, "</TH></TR>\n";
   $this->month=1;
   $this->year--;
  endif;
  if($this->year>=(int)substr($this->min, 0, 4)):
   if(1==$this->month) echo "<TR><TH>", $this->year, "</TH>\n";
   if($this->m()==$CFG->defaults->m)
    echo "<TD Class='Now'>";
   elseif($this->m()==$CFG->params->m)
    echo "<TD Class='Select'>";
   else
    echo "<TD>";
   return true;
  endif;
  $this->Done=1;
  $this->TR();
  echo "</Table>\n";
  return;
 }

 function m()
 {
  $m=sprintf("%04d%02d", $this->year, $this->month);
  if($m>=$this->min and $m<=$this->max) return $m;
  return;
 }

 function TR()
 {
  global $CFG;
  echo "<TR><TH Class='Corner'><BR /></TH>";
  foreach($CFG->months3 as $m) echo "<TH>$m</TH>";
  echo "<TH Class='Corner'><BR /></TH></TR>\n";
 }
}
?>
