CREATE TABLE centraldecostos (
    id_central_de_costos INT PRIMARY KEY AUTO_INCREMENT,
    nombre_del_costo VARCHAR(40)
);

CREATE TABLE tipodeproductos (
    id_tipo_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_tipo_de_producto VARCHAR(20)
);

CREATE TABLE gruposdelacarta (
    id_grupo INT PRIMARY KEY AUTO_INCREMENT,
    nro_orden INT(3),
    codigo_subgrupo VARCHAR(3),
    codigo_grupo VARCHAR(3),
    nombre_grupo VARCHAR(40)
);

CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_producto VARCHAR(50),
    descripcion_del_producto TEXT,
    tipo VARCHAR(4),
    tipo_de_unidad VARCHAR(6),
    id_grupo INT,
    id_central_de_costos INT,
    id_tipo_de_producto INT,
    cantidad_de_fracciones FLOAT(10,2),
    tipo_de_unidad_de_fracciones VARCHAR(4),
    fecha_de_vigencia DATE,
    stock_min_temporadabaja INT(3),
    stock_max_temporadabaja INT(3),
    stock_min_temporada_alta INT(3),
    stock_max_temporada_alta INT(3),
    requiere_programacion INT(1),
    tiempo_estimado VARCHAR(5),
    codigo_habilidad VARCHAR(20),
    tipo_comision VARCHAR(10),
    costo_unitario DECIMAL(10,2),
    costo_mano_de_obra DECIMAL(10,2),
    costo_adicional DECIMAL(10,2),
    porcentaje_margen DECIMAL(10,2),
    precioventa01 DECIMAL(10,2),
    precioventa02 DECIMAL(10,2),
    precioventa03 DECIMAL(10,2),
    id_impresora INT(2),
    FOREIGN KEY (id_grupo) REFERENCES gruposdelacarta(id_grupo),
    FOREIGN KEY (id_central_de_costos) REFERENCES centraldecostos(id_central_de_costos),
    FOREIGN KEY (id_tipo_de_producto) REFERENCES tipodeproductos(id_tipo_producto)
);
