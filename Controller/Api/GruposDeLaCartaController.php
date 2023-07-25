<?php
class GruposDeLaCartaController extends BaseController
{
  /**
   * "/GruposDeLaCarta/list" - Obtiene una lista de las centrales de costos
   */
  public function listAction()
  {
    $errorDesc = '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $queryStringParams = $this->getQueryStringParams();

    if (strtoupper($requestMethod) == 'GET') {
      try {
        $gruposDeLaCartaModel = new GruposDeLaCartaModel();
        $limit = $queryStringParams['limit'] ?? 10;
        $gruposDeLaCarta = $gruposDeLaCartaModel->getGruposDeLaCarta($limit);

        $responseData = json_encode($gruposDeLaCarta);
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
        $gruposDeLaCartaModel = new GruposDeLaCartaModel();
        $id = $queryStringParams['id'] ?? 1;
        $gruposDeLaCarta = $gruposDeLaCartaModel->getGruposDeLaCartaById($id);

        $responseData = json_encode($gruposDeLaCarta);
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
        $grupo = new GruposDeLaCartaModel();
        $gruposDeLaCarta = json_decode(file_get_contents('php://input'));

        $gruposDeLaCartaId = $grupo->createGruposDeLaCarta($gruposDeLaCarta);

        $responseData = json_encode(array('id_grupo' => $gruposDeLaCartaId));
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