DROP PROCEDURE IF EXISTS sp_beneficiario_ingreso;

CREATE PROCEDURE sp_beneficiario_ingreso (
    IN in_nombre VARCHAR(60),
    IN in_usuario INT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_beneficiario_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_beneficiario_ingreso
    Propósito:      Ingresar informacion a la tabla beneficiarios, asegurandose 
                    verificando el nombre antes de realizar el ingreso.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    29/03/2017  pgodoy      Creación del procedimiento
*/
`sp_beneficiario_ingreso`:
BEGIN
    IF (SELECT 1 FROM beneficiarios WHERE usuario_id = in_usuario AND nombre LIKE in_nombre) = 1 THEN
        SELECT '¡BENEFICIARIO REPETIDO!' INTO out_errormsg;
        LEAVE `sp_beneficiario_ingreso`;
    END IF;
    
    INSERT INTO beneficiarios (nombre, usuario_id)
    VALUES (in_nombre, in_usuario);
END;

#Ingreso de Beneficiarios
CALL sp_beneficiario_ingreso('Yop', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_beneficiario_ingreso('Sabegamo', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_beneficiario_ingreso('Empagua', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_beneficiario_ingreso('EEGSA', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_beneficiario_ingreso('Claro', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_beneficiario_ingreso('Muni', 1, @mensaje);
SELECT @mensaje as MENSAJE;
