DROP PROCEDURE IF EXISTS sp_cuenta_actualizainfo;

CREATE PROCEDURE sp_cuenta_actualizainfo (
    IN in_id INT,
    IN in_nombre VARCHAR(30), 
    IN in_descripcion VARCHAR(255),
    IN in_estado BIT, -- Activo (1); Inactivo (0)
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_cuenta_actualizainfo.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_cuenta_actualizainfo
    Propósito:      Permite modificar la informacion básica, no sensible, de la 
                    cuenta.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    10/04/2017  pgodoy      Creación del procedimiento
*/
`sp_cuenta_actualizainfo`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        SELECT 'ERROR AL REINGRESAR LA INFORMACIÓN DE LA CUENTA' INTO out_errormsg;
        ROLLBACK;
    END;

    IF (SELECT 1 FROM cuentas WHERE id = in_id AND usuario_id = in_usuario) != 1 THEN
        SELECT '¡EL USUARIO SOLO PUEDE MODIFICAR SUS CUENTAS!' INTO out_errormsg;
        LEAVE `sp_cuenta_actualizainfo`;
    END IF;

    IF (SELECT 1 FROM cuentas WHERE usuario_id = in_usuario 
        AND nombre LIKE in_nombre) = 1 THEN
        SELECT '¡NOMBRE DE LA CUENTA YA REGISTRADO PARA EL USUARIO!' INTO out_errormsg;
        LEAVE `sp_cuenta_actualizainfo`;
    END IF;
    
    UPDATE cuentas SET nombre = in_nombre, descripcion = in_descripcion, estado = in_estado WHERE id = in_id;
END;