<?

function visitor_thread_last_visit_from__d($vt, $u)
{
  $params = array(
      'conditions'=>array(
      'ip = ? and created_at < now() - interval ! second and visitor_thread_id = ?', ip2long($u->ip), VISITABLE_TIMEOUT, $vt->id
    ),
    'order'=>'created_at desc',
    'attributes'=>array(
      'ip'=>$u->ip,
      'visiting_user_id'=> ($u->id) ? $u->id : null,
      'visitor_thread_id'=>$vt->id,
      'affiliate_user_id'=>$_SESSION['affiliate_user_id']      
    )
    
  );
  if (!$u->id)
  {
    $params = ActiveRecord::add_conditions($params, array(
      'visiting_user_id is null'
    ));
  } else {
    $params = ActiveRecord::add_conditions($params, array(
      'visiting_user_id = ?', $u->id
    ));
  }
  
  $visit = Visitor::find_or_create_by($params);
  return $visit;
}



function visitor_thread_get_referer_count__d($vt)
{
  $aid = $vt->visited->affiliate_user_id;
  $sql = "select count(v.id) c from visitor_threads vt join visitors v on vt.id = v.visitor_thread_id where v.affiliate_user_id = $aid";
  $res = query_assoc($sql);
  return $res[0]['c'];
}

function visitor_thread_get_visited__d($vt)
{
  $klass = $vt->object_type;
  $obj = eval("return $klass::find_by_id(\$vt->object_id);");
  return $obj;
}

