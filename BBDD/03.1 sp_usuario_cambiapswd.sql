DROP PROCEDURE IF EXISTS sp_usuario_cambiapswd;

CREATE PROCEDURE sp_usuario_cambiapswd (
    IN in_id MEDIUMINT,
    IN in_contrasena VARCHAR(255),
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_usuario_cambiapswd.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_usuario_cambiapswd
    Propósito:      Cambia la contraseña del propio usuario.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoyg    Creación del procedimiento
*/
`sp_usuario_cambiapswd`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        IF ISNULL(out_errormsg) THEN
            SELECT '¡ERROR AL MODIFICAR USUARIO!' INTO out_errormsg;
        END IF;
        ROLLBACK;
    END;

    IF (in_id != in_usuario) THEN 
        SELECT '¡NO SE PUEDE CAMBIAR LA CONTRASEÑA DE OTRO USUARIO!' INTO out_errormsg;
        LEAVE `sp_usuario_cambiapswd`;
    END IF;

    UPDATE usuarios SET contrasena = fn_hashpsw(in_contrasena), modificado = NOW() WHERE id = in_id;
END;

