<?php
class Render {
  public function renderPage($template = "index", $chrome = true) {
    header('Content-Type: text/html; charset=utf-8');
    $templateDir = "template";
    $translationDir = "translations";
    $t = new Translation;
    $content_only = $chrome;
    $javascripts=array();
    if (is_dir($templateDir)) {
      $thisController = $template;
      if (is_file($templateDir."/header.template") && $chrome) {
        include($templateDir."/header.template");
      }

      if (is_file($templateDir."/".$template.".template") && $template != 'header' && $template != 'footer') {
        include($templateDir."/".$template.".template");
        if (!$chrome) {
          foreach($javascripts as $javascript){
            echo $javascript;
          }
        }
      }
      else {
        echo '<p style="font-family: sans-serif;">Template Not Found!</p>';
      }

      if ($chrome) {
        include($translationDir."/"._LANGUAGE_ISO_."_js.php");
      }

      if (is_file($templateDir."/footer.template") && $chrome) {
        include($templateDir."/footer.template");
      }
    }
    else {
      die('<p style="font-family: sans-serif;">No template directory!</p>');
    }
  }
}
