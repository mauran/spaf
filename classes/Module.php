<?php
class Module {
  public function _load() {
    self::getInstance()->loadModules();
  }
  public static $instance = null;
  public static function getInstance() {
      if (!self::$instance) {
          self::$instance = new Module();
      }
      return self::$instance;
  }
  public function loadModules() {
    $includedModules = array();
    foreach (glob("modules/*") as $dirname)
    {
      $module = basename($dirname);
      $modulePath = $dirname.'/'.$module.'.php';
      if (is_file($modulePath)) {
        require_once($modulePath);
        $includedModules[] = $module;
      }
    }
    foreach($includedModules as $module) {
      $function = '_load';
      if (method_exists($module,$function)) {
        call_user_func(array($module,$function));
      }
    }
  }
  public function isModule($module) {
    $modulePath = 'modules/'.$module.'/'.$module.'.php';
    if (is_file($modulePath)) {
      return true;
    }
    return false;
  }
  public function runModule($module) {
    $function = '_run';
    if (method_exists($module,$function)) {
      call_user_func(array($module,$function));
    }
  }
}
