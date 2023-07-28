<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ImpresorasModel extends Database
{
  public function getImpresoras($limit)
  {
    return $this->select("SELECT * FROM impresoras ORDER BY id_impresora ASC LIMIT ?", ["i", $limit]);
  }

  public function getImpresorasById($id)
  {
    $result = $this->select("SELECT * FROM impresoras WHERE id_impresora = ?", ["i", $id]);
    return (object) ($result[0] ?? null);
  }

  public function createImpresora($impresora)
  {
      $result = $this->insert("INSERT INTO impresoras (nombre_impresora, ubicacion, nro_ip) VALUES (?, ?, ?)", [
          "sss",
          $impresora->nombre_impresora,
          $impresora->ubicacion,
          $impresora->nro_ip
      ]);
      return $result;
  }  

  public function updateImpresoras($id, $impresora)
  {
      $result = $this->update("UPDATE impresoras SET nombre_impresora = ?, ubicacion = ?, nro_ip = ? WHERE id_impresora = ?", [
          "sssi",
          $impresora->nombre_impresora,
          $impresora->ubicacion,
          $impresora->nro_ip,
          $id
      ]);
      return $result;
  }

  public function deleteImpresoras($id)
  {
    $result = $this->delete("DELETE FROM impresoras WHERE id_impresora = ?", ["i", $id]);
    return $result;
  }
}