<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ProductosPaqueteModel extends Database
{
  public function getProductoPaquete($limit)
  {
    return $this->select("SELECT * FROM productospaquete ORDER BY id_paquete ASC LIMIT ?", ["i", $limit]);
  }

  public function getProductoPaqueteById($id)
  {
    $result = $this->select("SELECT * FROM productospaquete WHERE id_paquete = ?", ["i", $id]);
    return (object) ($result[0] ?? null);
  }

  public function createProductoPaquete($productoPaquete)
  {
    $result = $this->insert(
      "INSERT INTO productospaquete 
        (id_producto, id_producto_producto, cantidad, tipo_de_unidad) 
        VALUES (?, ?, ?, ?)",
      [
        "iiis",
        $productoPaquete->id_producto,
        $productoPaquete->id_producto_producto,
        $productoPaquete->cantidad,
        $productoPaquete->tipo_de_unidad
      ]
    );

    return $result;
  }
}