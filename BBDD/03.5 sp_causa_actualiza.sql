DROP PROCEDURE IF EXISTS sp_causa_actualiza;

CREATE PROCEDURE sp_causa_actualiza (
    IN in_id INT,
    IN in_nombre VARCHAR(30),
    IN in_ingreso BIT,
    IN in_causa_padre INT,
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_causa_actualiza.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_causa_actualiza
    Propósito:      Actualiza informacion de las causas ingresadas por los 
                    usuarios, manteniendo la integridad de acuerdo a los tipos 
                    de casusa ingresados.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoy      Creación del procedimiento
*/
`sp_causa_actualiza`:
BEGIN
    # @w_ingreso_padre   --causa padre activo/pasivo
    # @w_ingreso_hijo    --causa hijo activo/pasivo
    IF (SELECT COUNT(id) FROM cl_causas WHERE id = in_id AND usuario_id = in_usuario) = 0 THEN 
        SELECT '¡SOLO EL USUARIO PUEDE EDITAR SUS CAUSAS!' INTO out_errormsg;
        LEAVE `sp_causa_actualiza`;
    END IF;

    IF (SELECT COUNT(id) FROM movimientos WHERE causa_id = in_id) > 0 THEN
        SELECT '¡NO SE DEBE MODIFICAR CAUSAS QUE ESTEN EN USO!' INTO out_errormsg;
        LEAVE `sp_causa_actualiza`;
    END IF;

    IF (SELECT COUNT(id) FROM cl_causas WHERE id != in_id AND nombre LIKE in_nombre AND usuario_id = in_usuario) = 1 THEN
        SELECT '¡YA EXISTE OTRA CAUSA CON EL NOMBRE INGRESADO!' INTO out_errormsg;
        LEAVE `sp_causa_actualiza`;
    END IF;
    
    IF (SELECT COUNT(id) FROM cl_causas AS c1 INNER JOIN cl_causas AS c2 
        ON c1.id = c2.causa_id AND isnull(c1.causa_id))
END;