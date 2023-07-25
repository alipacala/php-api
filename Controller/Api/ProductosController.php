<?php
class ProductosController extends BaseController
{
  /**
   * "/Productos/list" - Obtiene una lista de los productos
   */
  public function listAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $productosModel = new ProductosModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $producto = $productosModel->getProducto($limit);

        $responseData = json_encode($producto);
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
        $productosModel = new ProductosModel();
        $id = $queryStringParams['id'] ?? 1;
        $Producto = $productosModel->getProductoById($id);

        $responseData = json_encode($Producto);
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
        $productosModel = new ProductosModel();
        $producto = json_decode(file_get_contents('php://input'));

        $productoId = $productosModel->createProducto($producto);

        $responseData = json_encode(array('id_producto' => $productoId));
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