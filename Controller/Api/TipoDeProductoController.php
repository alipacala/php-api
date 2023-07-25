<?php
class TipoDeProductoController extends BaseController
{
  /**
   * "/tipodeproducto/list" - Obtiene una lista de los tipos de producto
   */
  public function listAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $tipoDeProductoModel = new TipoDeProductoModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $TipoDeProducto = $tipoDeProductoModel->getTipoDeProducto($limit);

        $responseData = json_encode($TipoDeProducto);
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

  public function findOneAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $tipoDeProductoModel = new TipoDeProductoModel();
        $id = $queryStringParams['id'] ?? 1;
        $TipoDeProducto = $tipoDeProductoModel->getTipoDeProductoById($id);

        $responseData = json_encode($TipoDeProducto);
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

  public function createAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if (strtoupper($requestMethod) == 'POST') {
      try {
        $tipoDeProductoModel = new TipoDeProductoModel();
        $tipoDeProducto = json_decode(file_get_contents('php://input'));

        $tipoDeProductoId = $tipoDeProductoModel->createTipoDeProducto($tipoDeProducto);

        $responseData = json_encode(array('id_tipo_de_producto' => $tipoDeProductoId));
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