<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ProductosRecetaModel extends Database
{
  public function getProductoReceta($limit)
  {
    return $this->select("SELECT * FROM productosreceta ORDER BY id_receta ASC LIMIT ?", ["i", $limit]);
  }

  public function getProductoRecetaById($id)
  {
    $result = $this->select("SELECT * FROM productosreceta WHERE id_receta = ?", ["i", $id]);
    return (object) ($result[0] ?? null);
  }

  public function createProductoReceta($productoReceta)
  {
    $result = $this->insert(
      "INSERT INTO productosreceta 
          (id_producto, id_producto_insumo, cantidad, tipo_de_unidad) 
          VALUES (?, ?, ?, ?)",
      [
        "iiis",
        $productoReceta->id_producto,
        $productoReceta->id_producto_insumo,
        $productoReceta->cantidad,
        $productoReceta->tipo_de_unidad
      ]
    );

    return $result;
  }
}