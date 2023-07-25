<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class CentralDeCostosModel extends Database
{
  public function getCentralDeCostos($limit)
  {
    return $this->select("SELECT * FROM centraldecostos ORDER BY id_central_de_costos ASC LIMIT ?", ["i", $limit]);
  }

  public function getCentralDeCostosById($id)
  {
    $result = $this->select("SELECT * FROM centraldecostos WHERE id_central_de_costos = ?", ["i", $id]);
    return (object)($result[0] ?? null);
  }

  public function createCentralDeCostos($centraldecostos)
  {
    $result = $this->insert("INSERT INTO centraldecostos (nombre_del_costo) VALUES (?)", ["s", $centraldecostos->nombre_del_costo]);
    return $result;
  }
}