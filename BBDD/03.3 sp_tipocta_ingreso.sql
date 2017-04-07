DROP PROCEDURE IF EXISTS sp_tipocta_ingreso;

CREATE PROCEDURE sp_tipocta_ingreso (
    IN in_nombre VARCHAR(30),
    IN in_activo BIT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_tipocta_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_tipocta_ingreso
    Propósito:      Ingresar informacion a la tabla cl_tipo_cta, asegurandose 
                    de verificar el nombre antes de ingresar.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    29/03/2017  pgodoy      Creación del procedimiento
*/
`sp_tipocta_ingreso`:
BEGIN
    IF (SELECT 1 FROM cl_tipo_ctas WHERE nombre LIKE in_nombre) = 1 THEN
        SELECT '¡TIPO DE CUENTA YA EXISTE!' INTO out_errormsg;
        LEAVE `sp_tipocta_ingreso`;
    END IF;
    
    INSERT INTO cl_tipo_ctas (nombre, activo)
    VALUES (in_nombre, in_activo);
END;

#Ingreso de tipos de cuentas
CALL sp_tipocta_ingreso('Monetario', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_tipocta_ingreso('Ahorro', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_tipocta_ingreso('Fondo de Retiro', 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_tipocta_ingreso('T. Crédito', 0, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_tipocta_ingreso('Préstamo', 0, @mensaje);
SELECT @mensaje as MENSAJE;