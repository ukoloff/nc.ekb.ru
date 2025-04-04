<?php // Load Departments...

function loadDepts()
{
  global $CFG;
  $root = (object) null;
  $root->ch = array();
  if (!$CFG->sigur->uid)
    return;

  $s = $CFG->sigur->h->prepare(
    <<<SQL
      select
        ID as id,
        PARENT_ID as pid,
        NAME as name,
        exists(
          select
            *
          from
            personal as U
            join `tc-db-log`.logs as L on U.id = L.EMPHINT
            and substr(LOGDATA, 1, 2)=0xFE06
          where
            U.PARENT_ID = p.ID
        ) as Z
      from
        personal p
      where
        type = 'DEP'
        and STATUS = 'AVAILABLE'
      order by name
SQL
  );
  $s->execute();

  // doDebug();
  $idx = (object) null;
  while ($row = $s->fetch(PDO::FETCH_OBJ)):
    $key = $row->id;
    $idx->$key = $row;
    $row->count = 0;  // ���������� ���� ��������
    $row->ch = array();
  endwhile;

  foreach ($idx as $k => $v):
    $pid = $v->pid;
    $p = $idx->$pid;
    if (!$p)
      $p = $root;
    $p->ch[] = $v;
  endforeach;

  function count_children($dept)
  {
    $res = 0;
    foreach ($dept->ch as $k => $v):
      $res += count_children($v) + 1;
      if ($v->Z)
        $dept->Z = 1;  // � ������������� ������ ���� �������
    endforeach;
    return $dept->count = $res;
  }
  count_children($root);

  // �������� ������ ������������
  $s = $CFG->sigur->h->prepare(
    <<<SQL
      select
          EMP_ID
      from
          reportuserdep
      where
          USER_ID = ?
SQL
  );
  $s->execute(array($CFG->sigur->uid));
  while ($row = $s->fetch()):
    $id = $row[0];
    if ($idx->$id)
      $idx->$id->view = 1; // ��������, ��� ������� �������� �������������
  endwhile;

  function count_views($dept)
  {
    $res = 0;
    foreach ($dept->ch as $k => $v):
      $res += count_views($v);
      if ($v->view)
        $dept->view = 1;
    endforeach;
    $dept->vcount = $res;
    if ($dept->view)
      $res++;
    return $res;
  }
  count_views($root);

  if (!$root->vcount):
    foreach ($idx as $k => $v):
      if ($v->Z)
        $v->view = 1;
    endforeach;
    count_views($root);
  endif;

  function drop_depts($dept)
  {
    $dept->ch = array_values(array_filter($dept->ch, function ($v) {
      if (!$v->view)
        return;
      drop_depts(($v));
      return 1;
    }));
  }
  drop_depts($root);

  // ������� �������������, ������� ���������� ����� �������
  $root->avail = $root->vcount;
  foreach ($idx as $k => $v):
    if (!$v->view)
      continue;
    $v->ro = !$v->Z || $v->vcount && $v->vcount != $v->count;
    if ($v->ro)
      $root->avail--;
  endforeach;

  // �������� �������� ������������
  for ($d = $root; count($d->ch) == 1; $d = $d->ch[0])
    $d->expanded = 1;

  if ($root->avail == 1)
    foreach ($idx as $d)
      if ($d->view && !$d->ro):
        $d->checked = 1;
        break;
      endif;
  return $root;
}

function renderDepts($root)
{
  echo "\n<div id='/*'>\n";

  function out_dept($dept)
  {
    foreach ($dept->ch as $d):
      $collapse = !$d->expanded && count($d->ch);
      echo '<details', $collapse ? '' : ' open', '>',
        '<summary><label><input type=checkbox name=?', $d->id,
        $d->ro ? ' disabled' : '',
        $d->checked ? ' checked' : '',
        ">\n",
        htmlspecialchars($d->name),
        "</label></summary>\n";
      if (count($d->ch)):
        echo '<div id=/', $d->id, '>';
        out_dept($d);
        echo "</div>";
      endif;
      echo "</details>";
    endforeach;
  }
  out_dept($root);
  echo "</div>";
}

function index_depts($dept, $idx = null)
{
  if ($idx === null)
    $idx = (object) null;
  foreach ($dept->ch as $d):
    index_depts($d, $idx);
    if ($d->ro)
      continue;
    $id = $d->id;
    $idx->$id = 1;
  endforeach;
  return $idx;
}
