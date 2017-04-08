DROP PROCEDURE IF EXISTS sp_usuario_alternaestado;

CREATE PROCEDURE sp_usuario_alternaestado (
    IN in_id MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_usuario_alternaestado.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_usuario_alternaestado
    Propósito:      Habilita o des-habilita al usuario

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoyg    Creación del procedimiento
*/
`sp_usuario_alternaestado`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        IF ISNULL(out_errormsg) THEN
            SELECT '¡ERROR AL CAMBIAR EL ESTADO DEL USUARIO!' INTO out_errormsg;
        END IF;
        ROLLBACK;
    END;

    IF (SELECT activo FROM usuarios WHERE id = in_id) THEN 
        UPDATE usuarios SET activo = 0 WHERE id = in_id;
    ELSE
        UPDATE usuarios SET activo = 1 WHERE id = in_id;
    END IF;
END;

