CREATE DATABASE presupuesto;
USE presupuesto;

DROP TABlE IF EXISTS movimientos, cuentas, cl_causas, cl_monedas, cl_tipo_ctas, beneficiarios, usuarios, correlativos;

CREATE TABLE correlativos(
    id INT AUTO_INCREMENT,
    tabla VARCHAR(30) NOT NULL,
    secuencial INT NOT NULL DEFAULT 1000000,

    CONSTRAINT correlativos_pk_id PRIMARY KEY (id),
    CONSTRAINT correlativos_unq_tabla UNIQUE (tabla)
);
INSERT INTO correlativos (tabla)
VALUES ('movimientos');

CREATE TABLE usuarios(
    id MEDIUMINT AUTO_INCREMENT,
    usuario VARCHAR(10) NOT NULL,
    nombre VARCHAR(60) NOT NULL,
    correo VARCHAR(120) NOT NULL DEFAULT '',
    contrasena VARCHAR(255) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modificado DATETIME DEFAULT NULL,

    CONSTRAINT usuarios_pk_id PRIMARY KEY (id),
    CONSTRAINT usuarios_unq_usuario UNIQUE (usuario),
    CONSTRAINT usuarios_unq_correo UNIQUE (correo),
    FULLTEXT INDEX usuarios_idx_usuario (usuario)
);

CREATE TABLE beneficiarios(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    usuario_id MEDIUMINT NOT NULL,

    CONSTRAINT beneficiarios_tabla_pk_id PRIMARY KEY (id),
    CONSTRAINT beneficiarios_fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE cl_tipo_ctas(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1, -- activo(+); pasivo(-)

    CONSTRAINT cl_tipo_ctas_pk_id PRIMARY KEY (id),
    CONSTRAINT cl_tipo_ctas_unq_nombre UNIQUE (nombre)
);

CREATE TABLE cl_monedas(
    id MEDIUMINT AUTO_INCREMENT,
    simbolo VARCHAR(3) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    pais VARCHAR(30) NOT NULL,

    CONSTRAINT cl_monedas_pk_id PRIMARY KEY (id),
    CONSTRAINT cl_monedas_unq_simbolo UNIQUE (simbolo),
    CONSTRAINT cl_monedas_unq_nombre UNIQUE (nombre)
);

CREATE TABLE cl_causas(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    ingreso TINYINT(1) NOT NULL DEFAULT 1, -- Ingreso (1), Egreso (0)
    causa_id INT,
    usuario_id MEDIUMINT NOT NULL,

    CONSTRAINT cl_causas_pk_id PRIMARY KEY (id),
    CONSTRAINT cl_causas_fk_categoria FOREIGN KEY (causa_id) REFERENCES cl_causas(id),
    CONSTRAINT cl_causas_fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE cuentas(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    tipo_id INT NOT NULL,
    moneda_id MEDIUMINT NOT NULL,
    saldo NUMERIC(15,2) NOT NULL DEFAULT 0,
    descripcion VARCHAR(255) DEFAULT NULL,
    estado TINYINT(1) NOT NULL DEFAULT 1, -- Activo (1); Inactivo (0)
    usuario_id MEDIUMINT NOT NULL,

    CONSTRAINT cuentas_pk_id PRIMARY KEY (id),
    CONSTRAINT cuentas_fk_moneda FOREIGN KEY (moneda_id) REFERENCES cl_monedas(id),
    CONSTRAINT cuentas_fk_tipo FOREIGN KEY (tipo_id) REFERENCES cl_tipo_ctas(id),
    CONSTRAINT cuentas_fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE movimientos(
    id BIGINT AUTO_INCREMENT,
    cuenta_id INT NOT NULL,
    correlativo INT NOT NULL,
    fecha_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    causa_id INT NOT NULL,
    beneficiario_id INT NOT NULL,
    monto NUMERIC(15,2) NOT NULL,
    descripcion VARCHAR(90) NOT NULL DEFAULT '',

    CONSTRAINT movimientos_pk_id PRIMARY KEY (id),
    CONSTRAINT movimientos_fk_cuenta FOREIGN KEY (cuenta_id) REFERENCES cuentas(id),
    CONSTRAINT movimientos_fk_categoria FOREIGN KEY (causa_id) REFERENCES cl_causas(id),
    CONSTRAINT movimientos_fk_beneficiario FOREIGN KEY (beneficiario_id) REFERENCES beneficiarios(id)
);


SELECT * FROM movimientos;
SELECT * FROM cuentas;
SELECT * FROM cl_causas;
SELECT * FROM cl_monedas;
SELECT * FROM cl_tipo_ctas;
SELECT * FROM beneficiarios;
SELECT * FROM usuarios;
SELECT * FROM correlativos;