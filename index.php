<?php
try {
  require __DIR__ . "/inc/bootstrap.php";
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $uri = explode('/', $uri);

  if ((isset($uri[1]) && $uri[1] != 'user') || !isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    exit();
  }

  require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
  $objFeedController = new UserController();
  $strMethodName = $uri[2] . 'Action';
  $objFeedController->{$strMethodName}();
} catch (Exception $e) {
  header("HTTP/1.1 500 Internal Server Error");
  print($e->getMessage());
  exit();
}
?>