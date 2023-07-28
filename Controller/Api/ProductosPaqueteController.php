<?php
class ProductosPaqueteController extends BaseController
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
        $ProductosPaquete = new ProductosPaqueteModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $productoPaquete = $ProductosPaquete->getProductoPaquete($limit);

        $responseData = json_encode($productoPaquete);
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
        $ProductosPaquete = new ProductosPaqueteModel();
        $id = $queryStringParams['id'] ?? 1;
        $productoPaquete = $ProductosPaquete->getProductoPaqueteById($id);

        $responseData = json_encode($productoPaquete);
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
        $ProductosPaquete = new ProductosPaqueteModel();
        $productoPaquete = json_decode(file_get_contents('php://input'));

        $productoPaqueteId = $ProductosPaquete->createProductoPaquete($productoPaquete);

        $responseData = json_encode(array('id_paquete' => $productoPaqueteId));
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