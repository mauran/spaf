<?php
class Controller {
  public static $instance = null;
  public static $controllerFetched = null;
  public static function getInstance() {
      if (!self::$instance) {
          self::$instance = new Controller();
      }
      return self::$instance;
  }
  public static function fetchController() {
    if (self::$instance && !self::$controllerFetched) {
      $render = new Render();
      $page = Post::getInputQuery('p');
      $module = Post::getInputQuery('m');
      $chrome = true;
      if (Post::getQuery('content_only')) {
        $chrome = false;
      }
      if ($module && Module::isModule($module)) {
        Module::runModule($module);
      }
      else {
        if ($page) {
          switch ($page) {
            default:
              $render->renderPage($page, $chrome);
            break;
          }
        }
        else {
          $render->renderPage('index',$chrome);
        }
      }
      self::$controllerFetched = true;
    }
  }
}
