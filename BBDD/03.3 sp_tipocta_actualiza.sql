DROP PROCEDURE IF EXISTS sp_tipocta_actualiza;

CREATE PROCEDURE sp_tipocta_actualiza (
    IN in_id INT,
    IN in_nombre VARCHAR(30),
    IN in_activo BIT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_tipocta_actualiza.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_tipocta_actualiza
    Propósito:      Actualiza el tipo de cuenta.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoy      Creación del procedimiento
*/
`sp_tipocta_actualiza`:
BEGIN
    IF (SELECT COUNT(id) FROM cuentas WHERE tipo_id = in_id) > 0 THEN
        SELECT '¡NO SE DEBE ACTUALIZAR UN TIPO QUE UTILIZADO POR CUALQUIER USUARIO!' INTO out_errormsg;
        LEAVE `sp_tipocta_actualiza`;
    END IF;

    IF (SELECT 1 FROM cl_tipo_ctas WHERE id != in_id AND nombre LIKE in_nombre) = 1 THEN
        SELECT '¡TIPO DE CUENTA YA EXISTE!' INTO out_errormsg;
        LEAVE `sp_tipocta_actualiza`;
    END IF;
    
    UPDATE cl_tipo_ctas SET nombre = in_nombre WHERE id = in_id;
END;