<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class GruposDeLaCartaModel extends Database
{
  public function getGruposDeLaCarta($limit)
  {
    return $this->select("SELECT * FROM gruposdelacarta ORDER BY id_grupo ASC LIMIT ?", ["i", $limit]);
  }

  public function getGruposDeLaCartaById($id)
  {
    $result = $this->select("SELECT * FROM gruposdelacarta WHERE id_grupo = ?", ["i", $id]);
    return (object)($result[0] ?? null);
  }

  public function createGruposDeLaCarta($gruposDeLaCarta)
  {
    $result = $this->insert("INSERT INTO gruposdelacarta (nro_orden, codigo_subgrupo, codigo_grupo, nombre_grupo) VALUES (?, ?, ?, ?)", ["isss", $gruposDeLaCarta->nro_orden, $gruposDeLaCarta->codigo_subgrupo, $gruposDeLaCarta->codigo_grupo, $gruposDeLaCarta->nombre_grupo]);
    return $result;
  }
}