class Post {
  public static function isPostback() {
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
      return true;
    }
    else {
      return false;
    }
  }
  public static function getInputPost($keyName) {
    $post = self::getPost($keyName);
    if ($post !== true) {
      return $post;
    }
    return false;
  }
  public static function getPost($keyName) {
    if(array_key_exists($keyName, $_POST)) {
      if($_POST[$keyName] != '') {
        return $_POST[$keyName];
      }
      return true;
    }
    return false;
  }
  public static function getInputQuery($keyName) {
    $post = self::getQuery($keyName);
    if ($post !== true) {
      return $post;
    }
    return false;
  }
  public static function getQuery($keyName) {
    parse_str($_SERVER['QUERY_STRING'],$queries);
    if(array_key_exists($keyName, $queries)) {
      if($queries[$keyName] != '') {
        return $queries[$keyName];
      }
      return true;
    }
    return false;
  }
}
