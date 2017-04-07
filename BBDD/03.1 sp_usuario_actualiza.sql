DROP PROCEDURE IF EXISTS sp_usuario_actualiza;

CREATE PROCEDURE sp_usuario_actualiza (
    IN in_id MEDIUMINT,
    IN in_nombre VARCHAR(60),
    IN in_correo VARCHAR(120),
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_usuario_actualiza.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_usuario_actualiza
    Propósito:      Actualizar la información del usuario que no interfiere con 
                    el proceso de autenticación.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoyg    Creación del procedimiento
*/
`sp_usuario_actualiza`:
BEGIN
    # declaración de variables
    
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        IF ISNULL(out_errormsg) THEN
            SELECT '¡ERROR AL MODIFICAR USUARIO!' INTO out_errormsg;
        END IF;
        ROLLBACK;
    END;

    IF (in_id != in_usuario) THEN 
        SELECT '¡NO SE PUEDE EDITAR LA INFORMACIÓN DE OTRO USUARIO!' INTO out_errormsg;
        LEAVE `sp_usuario_actualiza`;
    END IF;

    IF (SELECT 1 FROM usuarios WHERE id != in_id AND correo LIKE in_correo) = 1 THEN
        SELECT '¡EL CORREO ESTA REGISTRADO CON OTRO USUARIO!' INTO out_errormsg;
        LEAVE `sp_usuario_actualiza`;
    END IF;

    UPDATE usuarios SET nombre = in_nombre, correo = in_correo, modificado = NOW() WHERE id = in_id;
END;

