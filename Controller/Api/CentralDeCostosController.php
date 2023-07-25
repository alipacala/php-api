<?php
class CentralDeCostosController extends BaseController
{
  /**
   * "/centraldecostos/list" - Obtiene una lista de las centrales de costos
   */
  public function listAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $centralDeCostosModel = new CentralDeCostosModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $centralDeCostos = $centralDeCostosModel->getCentralDeCostos($limit);

        $responseData = json_encode($centralDeCostos);
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
        $centralDeCostosModel = new CentralDeCostosModel();
        $id = $queryStringParams['id'] ?? 1;
        $centralDeCostos = $centralDeCostosModel->getCentralDeCostosById($id);

        $responseData = json_encode($centralDeCostos);
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
        $userModel = new CentralDeCostosModel();
        $centralDeCostos = json_decode(file_get_contents('php://input'));

        $centralDeCostosId = $userModel->createCentralDeCostos($centralDeCostos);

        $responseData = json_encode(array('id_central_de_costos' => $centralDeCostosId));
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