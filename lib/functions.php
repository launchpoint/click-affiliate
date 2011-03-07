<?

function get_visitor_thread($s, $name)
{
  $vt = VisitorThread::find_or_create_by( array(
    'conditions'=>array("name = ? and object_type = ? and object_id = ?", $name, $s->klass, $s->id),
    'attributes'=>array(
     'name'=>$name,
     'object_type'=>$s->klass,
     'object_id'=>$s->id
    )
  ));
  return $vt;
}

function log_visit($s, $u)
{
  global $params;

  if (array_key_exists('a', $params))
  {
    $_SESSION['affiliate_user_id'] = $params['a'];
  }
  if (!array_key_exists('affiliate_user_id', $_SESSION))
  {
    $_SESSION['affiliate_user_id'] = 0;
  }
  if (!array_key_exists('last_visit', $_SESSION))
  {
    $_SESSION['last_visit'] = time();
    return $s->last_visit_from($u);
  }
  $t = $_SESSION['last_visit'];
  if (time()-$t<VISITABLE_TIMEOUT) return; // has been logged recently
  
  return $s->last_visit_from($u);
}