<?php
try {
    require __DIR__ . "/inc/bootstrap.php";

    $uri = RequestHandler::getUriSegments();

    $controllersNames = array('CentralDeCostos', 'GruposDeLaCarta', 'TipoDeProducto', 'Productos', 'Impresoras', 'ProductosPaquete', 'ProductosReceta');

    if (!isset($uri[3]) || (isset($uri[2]) && !in_array($uri[2], $controllersNames))) {
        RequestHandler::sendNotFoundResponse();
    }

    $controllerName = ucfirst($uri[2]) . 'Controller';
    $controllerFile = PROJECT_ROOT_PATH . "/Controller/Api/{$controllerName}.php";

    if (!file_exists($controllerFile)) {
        RequestHandler::sendNotFoundResponse();
    }

    require $controllerFile;
    $controller = new $controllerName();

    $methodName = $uri[3] . 'Action';

    if (!method_exists($controller, $methodName)) {
        RequestHandler::sendNotFoundResponse();
    }

    $controller->{$methodName}();
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error");
    print($e->getMessage());
    exit();
}
?>