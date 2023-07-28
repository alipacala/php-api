<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";
require_once PROJECT_ROOT_PATH . "RequestHandler.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/Model/CentralDeCostosModel.php";
require_once PROJECT_ROOT_PATH . "/Model/GruposDeLaCartaModel.php";
require_once PROJECT_ROOT_PATH . "/Model/TipoDeProductoModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ProductosModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ImpresorasModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ProductosPaqueteModel.php";
require_once PROJECT_ROOT_PATH . "/Model/ProductosRecetaModel.php";
?>