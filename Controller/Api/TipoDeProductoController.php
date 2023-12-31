<?php
class TipoDeProductoController extends BaseController
{
  public function listarAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

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

  public function buscarPorIdAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

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

  public function crearAction()
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

  public function modificarAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

    if (strtoupper($requestMethod) == 'PUT') {
      try {
        $tipoDeProductoModel = new TipoDeProductoModel();
        $tipoDeProducto = json_decode(file_get_contents('php://input'));

        $id = $queryStringParams['id'] ?? 1;

        $tipoDeProductoId = $tipoDeProductoModel->updateTipoDeProducto($id, $tipoDeProducto);

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

  public function eliminarAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = RequestHandler::getQueryStringParams();

    if (strtoupper($requestMethod) == 'DELETE') {
      try {
        $tipoDeProductoModel = new TipoDeProductoModel();

        $id = $queryStringParams['id'] ?? 1;

        $tipoDeProductoId = $tipoDeProductoModel->deleteTipoDeProducto($id);

        if ($tipoDeProductoId == 0) {
          $errorDesc = 'No se pudo eliminar el tipo de producto';
          $errorHeader = 'HTTP/1.1 500 Internal Server Error';
        } else {
          $responseData = json_encode(array('mensaje' => 'Tipo de producto eliminado correctamente'));
        }
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