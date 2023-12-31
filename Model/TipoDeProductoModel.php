<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class TipoDeProductoModel extends Database
{
  public function getTipoDeProducto($limit)
  {
    return $this->select("SELECT * FROM tipodeproductos ORDER BY id_tipo_producto ASC LIMIT ?", ["i", $limit]);
  }

  public function getTipoDeProductoById($id)
  {
    $result = $this->select("SELECT * FROM tipodeproductos WHERE id_tipo_producto = ?", ["i", $id]);
    return (object)($result[0] ?? null);
  }

  public function createTipoDeProducto($tipoDeProducto)
  {
    $result = $this->insert("INSERT INTO tipodeproductos (nombre_tipo_de_producto) VALUES (?)", ["s", $tipoDeProducto->nombre_tipo_de_producto]);
    return $result;
  }

  public function updateTipoDeProducto($id, $tipoDeProducto)
  {
    $result = $this->update("UPDATE tipodeproductos SET nombre_tipo_de_producto = ? WHERE id_tipo_producto = ?", ["si", $tipoDeProducto->nombre_tipo_de_producto, $id]);
    return $result;
  }

  public function deleteTipoDeProducto($id)
  {
    $result = $this->delete("DELETE FROM tipodeproductos WHERE id_tipo_producto = ?", ["i", $id]);
    return $result;
  }
}