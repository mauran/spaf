<?php
class Modules {
  public function _load() {
    self::getInstance()->includeModules();
  }
  public static $instance = null;
  public static function getInstance() {
      if (!self::$instance) {
          self::$instance = new Modules();
      }
      return self::$instance;
  }
  public function includeModules() {
    $includedModules = array();
    foreach (glob("modules/*") as $dirname)
    {
      $module = basename($dirname);
      $modulePath = $dirname.'/'.$module.'.php';
      if (is_file($modulePath)) {
        require_once($modulePath);
        $includedModules[] = $module;
      }
      foreach($includedModules as $module) {
        $function = '_load';
        if (method_exists($module,$function)) {
          call_user_func(array($module,$function));
        }
      }
    }
  }
}
