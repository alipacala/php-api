<?php
class ProductosRecetaController extends BaseController
{
  /**
   * "/Productos/list" - Obtiene una lista de los productos
   */
  public function listarAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $ProductosReceta = new ProductosRecetaModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $productoReceta = $ProductosReceta->getProductoReceta($limit);

        $responseData = json_encode($productoReceta);
      } catch (Error $e) {
        $errorDesc = $e->getMessage() . 'Algo salió mal';
        $errorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $errorDesc = 'Método no permitido';
      $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    if (!$errorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(
        json_encode(array('error' => $errorDesc)),
        array('Content-Type: application/json', $errorHeader)
      );
    }
  }

  public function buscarPorIdAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $ProductosReceta = new ProductosRecetaModel();
        $id = $queryStringParams['id'] ?? 1;
        $productoReceta = $ProductosReceta->getProductoRecetaById($id);

        $responseData = json_encode($productoReceta);
      } catch (Error $e) {
        $errorDesc = $e->getMessage() . 'Algo salió mal';
        $errorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $errorDesc = 'Método no permitido';
      $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    if (!$errorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(
        json_encode(array('error' => $errorDesc)),
        array('Content-Type: application/json', $errorHeader)
      );
    }
  }

  public function crearAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if (strtoupper($requestMethod) == 'POST') {
      try {
        $ProductosReceta = new ProductosRecetaModel();
        $productoReceta = json_decode(file_get_contents('php://input'));

        $productoRecetaId = $ProductosReceta->createProductoReceta($productoReceta);

        $responseData = json_encode(array('id_paquete' => $productoRecetaId));
      } catch (Error $e) {
        $errorDesc = $e->getMessage() . 'Algo salió mal';
        $errorHeader = 'HTTP/1.1 500 Internal Server Error';
      }
    } else {
      $errorDesc = 'Método no permitido';
      $errorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    }

    if (!$errorDesc) {
      $this->sendOutput(
        $responseData,
        array('Content-Type: application/json', 'HTTP/1.1 200 OK')
      );
    } else {
      $this->sendOutput(
        json_encode(array('error' => $errorDesc)),
        array('Content-Type: application/json', $errorHeader)
      );
    }
  }
}