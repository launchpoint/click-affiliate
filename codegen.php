<?

global $affiliate_settings;

if(!$affiliate_settings['models']) dprint("Error. No affiliate models defined.");

foreach($affiliate_settings['models'] as $model_name)
{
  $m = strtolower($model_name);
  
  $code = <<<PHP

function {$m}_log_visit(\$o, \$u)
{
  return log_visit(\$o, \$u);
}

function {$m}_last_visit_from__d(\$o, \$u)
{
  \$o->visitor_thread->last_visit_from(\$u);
}

function {$m}_get_visitor_thread__d(\$o)
{
  return \$o->visitor_thread();
}


function {$m}_visitor_thread__d(\$o, \$name='default')
{
  \$vt = get_visitor_thread(\$o, \$name);
  return \$vt;
}

function {$m}_get_visitor_count__d(\$o)
{
  return \$o->visitor_count();
}

function {$m}_visitor_count__d(\$o, \$name='default')
{
  return \$o->visitor_thread(\$name)->visitor_count;
}

function {$m}_get_referer_count__d(\$o)
{
  return \$o->referer_count();
}

function {$m}_referer_count__d(\$o, \$name='default')
{
  return \$o->visitor_thread(\$name)->referer_count;
}
  
PHP;
  $codegen[] = $code;
}

