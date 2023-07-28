<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class ProductosModel extends Database
{
  public function getProducto($limit)
  {
    return $this->select("SELECT * FROM productos ORDER BY id_producto ASC LIMIT ?", ["i", $limit]);
  }

  public function getProductoById($id)
  {
    $result = $this->select("SELECT * FROM productos WHERE id_producto = ?", ["i", $id]);
    return (object) ($result[0] ?? null);
  }

  public function createProducto($producto)
  {
    $result = $this->insert(
      "INSERT INTO productos
          (nombre_producto, descripcion_del_producto, tipo, tipo_de_unidad, 
           id_grupo, id_central_de_costos, id_tipo_de_producto, cantidad_de_fracciones, 
           tipo_de_unidad_de_fracciones, fecha_de_vigencia, stock_min_temporada_baja, 
           stock_max_temporada_baja, stock_min_temporada_alta, stock_max_temporada_alta, 
           requiere_programacion, tiempo_estimado, codigo_habilidad, tipo_comision, 
           costo_unitario, costo_mano_de_obra, costo_adicional, porcentaje_margen, 
           precio_venta_01, precio_venta_02, precio_venta_03, id_impresora, activo) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
      [
        "ssssiiiiisiiiiiiisdddddddii",
        $producto->nombre_producto,
        $producto->descripcion_del_producto,
        $producto->tipo,
        $producto->tipo_de_unidad,
        $producto->id_grupo,
        $producto->id_central_de_costos,
        $producto->id_tipo_de_producto,
        $producto->cantidad_de_fracciones,
        $producto->tipo_de_unidad_de_fracciones,
        $producto->fecha_de_vigencia,
        $producto->stock_min_temporada_baja,
        $producto->stock_max_temporada_baja,
        $producto->stock_min_temporada_alta,
        $producto->stock_max_temporada_alta,
        $producto->requiere_programacion,
        $producto->tiempo_estimado,
        $producto->codigo_habilidad,
        $producto->tipo_comision,
        $producto->costo_unitario,
        $producto->costo_mano_de_obra,
        $producto->costo_adicional,
        $producto->porcentaje_margen,
        $producto->precio_venta_01,
        $producto->precio_venta_02,
        $producto->precio_venta_03,
        $producto->id_impresora,
        $producto->activo
      ]
    );

    return $result;
  }
}