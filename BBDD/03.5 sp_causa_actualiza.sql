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
    SET @w_hijo_id = 0,
        @w_hijo_ingreso = 0;

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


    SELECT @w_hijo_id := c2.id, @w_hijo_ingreso := c2.ingreso #c1.nombre AS CAUSA, c2.nombre AS HIJO
    FROM cl_causas AS c1 INNER JOIN cl_causas AS c2 ON c1.id = c2.causa_id AND c1.id = in_id LIMIT 1;

    IF ISNULL(in_causa_padre) THEN
        IF (@w_hijo_id) THEN
            IF @w_hijo_ingreso = in_ingreso THEN
                UPDATE cl_causas 
                SET nombre = in_nombre, ingreso = in_ingreso, causa_id = NULL 
                WHERE id = in_id;
            ELSE
                SELECT 'NO COINCIDEN LOS TIPOS DE CUENTA' INTO out_errormsg;
                LEAVE `sp_causa_actualiza`;
            END IF;
        ELSE
            # no tiene hijo y se asigna un padre null, solo se actualiza
            UPDATE cl_causas 
            SET nombre = in_nombre, ingreso = in_ingreso, causa_id = NULL 
            WHERE id = in_id;
        END IF;
    ELSE
        IF (@w_hijo_id) THEN
            IF (SELECT ingreso FROM cl_causas WHERE id = in_causa_padre) = @w_hijo_ingreso AND in_ingreso = @w_hijo_ingreso THEN
                UPDATE cl_causas 
                SET nombre = in_nombre, ingreso = in_ingreso, causa_id = in_causa_padre 
                WHERE id = in_id;
            ELSE
                SELECT 'NO COINCIDEN LOS TIPOS DE CUENTA' INTO out_errormsg;
                LEAVE `sp_causa_actualiza`;
            END IF;
        ELSE
            IF (SELECT ingreso FROM cl_causas WHERE id = in_causa_padre) = in_ingreso THEN
                UPDATE cl_causas 
                SET nombre = in_nombre, ingreso = in_ingreso, causa_id = in_causa_padre 
                WHERE id = in_id;
            ELSE
                SELECT 'NO COINCIDEN LOS TIPOS DE CUENTA' INTO out_errormsg;
                LEAVE `sp_causa_actualiza`;
            END IF;
        END IF;
    END IF; 
END;