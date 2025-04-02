<? // Отдать фотку для вставки в AD
require_once(dirname(__FILE__).'/sigur.connect.php');
LoadLib('../user/jpg10k');

function getJPG($N)
{
  global $CFG;
  $s = $CFG->sigur->prepare(<<<SQL
  Select
    HIRES_RASTER
  From
    photo
  Where
    ID=?
SQL
  );
  $s->execute(Array($N));
  $row = $s->fetch();
  if(!$row or !strlen($row[0])) return;

  return jpgShrink10k($row[0]);
}

function getJpgByNo($tabN)
{ // Получить фотку по табельному номеру
//  doDebug();
  global $CFG;
  $s = $CFG->sigur->prepare(<<<SQL
    Select	ID
    From	personal
    Where	TABID in (?, ?)
SQL
  );
  $s->execute(Array($tabN, "0$tabN"));
  $row = $s->fetch();
  if(!$row) return;
  if($s->fetch()) return;	// 2 и более совпадений
  return getJPG($row[0]);
}

?>
