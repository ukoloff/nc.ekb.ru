<?
global $CFG;

if($CFG->intraNet):
 echo "&raquo;\n������� ����� � <A hRef='file://", 
    htmlspecialchars(rawurlencode($CFG->Samba->Server.'/'.
    $CFG->Samba->normalizePath($CFG->Samba->Folder.'/'.$CFG->Samba->Path.'/'.$CFG->params->path))),
    "' Target='_blank'>����������</A><BR />\n";
endif;

$F=$CFG->Samba->listFolder($CFG->params->path);
if($F):
  ListFolder($F, '<HR />');
  ListFolder($F);
else:
  echo "&raquo; ����� �����\n";
endif;

function ListFolder($F, $dir='')
{
 global $CFG;
 $notfile=!!$dir;
 $N=0;
 foreach($F as $z):
  if($notfile!=!$z->isFile) continue;
  $title=strftime('%x %X', $z->Time);
  if($z->Size) $title.="\n".$z->Size.' ����';
  echo "<A hRef='./",
    htmlspecialchars(hRef('path', $CFG->Samba->winPath($CFG->params->path."\\".$z->Name))), "' Title='", 
    htmlspecialchars($title), "'>",
    htmlspecialchars($z->Name), '</A>';
  if(!$z->isFile) echo "\\";
  echo "\n";
  $N++;
 endforeach;
 if($N) echo $dir;
}

?>
