<?php
try {
    require __DIR__ . "/inc/bootstrap.php";
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode('/', $uri);

    $controllersNames = array('CentralDeCostos', 'GruposDeLaCarta', 'TipoDeProducto', 'Productos');

    if (!isset($uri[3]) || (isset($uri[2]) && !in_array($uri[2], $controllersNames))) {
      header("HTTP/1.1 404 Not Found");
      exit();
  }

    $controllerName = ucfirst($uri[2]) . 'Controller';
    $controllerFile = PROJECT_ROOT_PATH . "/Controller/Api/{$controllerName}.php";

    if (!file_exists($controllerFile)) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

    require $controllerFile;
    $controller = new $controllerName();

    $methodName = $uri[3] . 'Action';

    if (!method_exists($controller, $methodName)) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

    $controller->{$methodName}();
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    print($e->getMessage());
    exit();
}
?>