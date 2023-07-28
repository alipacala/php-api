<?php
class ImpresorasController extends BaseController
{
  /**
   * "/Impresoras/list" - Obtiene una lista de los tipos de producto
   */
  public function listarAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams =RequestHandler::getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $ImpresorasModel = new ImpresorasModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $Impresoras = $ImpresorasModel->getImpresoras($limit);

        $responseData = json_encode($Impresoras);
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
        $ImpresorasModel = new ImpresorasModel();
        $id = $queryStringParams['id'] ?? 1;
        $Impresoras = $ImpresorasModel->getImpresorasById($id);

        $responseData = json_encode($Impresoras);
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
        $ImpresorasModel = new ImpresorasModel();
        $Impresoras = json_decode(file_get_contents('php://input'));

        $ImpresorasId = $ImpresorasModel->createImpresora($Impresoras);

        $responseData = json_encode(array('id_tipo_de_producto' => $ImpresorasId));
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
        $ImpresorasModel = new ImpresorasModel();
        $Impresoras = json_decode(file_get_contents('php://input'));

        $id = $queryStringParams['id'] ?? 1;

        $ImpresorasId = $ImpresorasModel->updateImpresoras($id, $Impresoras);

        $responseData = json_encode(array('id_tipo_de_producto' => $ImpresorasId));
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
        $ImpresorasModel = new ImpresorasModel();

        $id = $queryStringParams['id'] ?? 1;

        $ImpresorasId = $ImpresorasModel->deleteImpresoras($id);

        if ($ImpresorasId == 0) {
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