<?php
ini_set("session.cookie_lifetime", 86400);
require_once('settings.php');
$includedClasses = array();
foreach (glob("classes/*.php") as $filename)
{
  require_once($filename);
  $class = str_replace('.php', '', basename($filename));
  $includedClasses[] = $class;
}
foreach($includedClasses as $class) {
  $function = '_load';
  if (method_exists($class,$function) && $class != 'Init') {
    call_user_func(array($class,$function));
  }
}
if (method_exists('Init',$function)) {
  call_user_func(array('Init',$function));
}
