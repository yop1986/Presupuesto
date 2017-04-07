DROP PROCEDURE IF EXISTS sp_beneficiario_actualiza;

CREATE PROCEDURE sp_beneficiario_actualiza (
    IN in_id INT,
    IN in_nombre VARCHAR(60),
    IN in_usuario INT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_beneficiario_actualiza.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_beneficiario_actualiza
    Propósito:      Actualiza el nombre de un beneficiario

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoy      Creación del procedimiento
*/
`sp_beneficiario_actualiza`:
BEGIN
    IF (SELECT COUNT(id) FROM beneficiarios WHERE id = in_id AND usuario_id = in_usuario) = 0 THEN
        SELECT '¡SOLO SE PUEDE MODIFICAR LOS BENEFICIARIOS PROPIOS!' INTO out_errormsg;
        LEAVE `sp_beneficiario_actualiza`;
    END IF; 

    IF (SELECT 1 FROM beneficiarios 
        WHERE usuario_id = in_usuario AND id != in_id AND nombre LIKE in_nombre) = 1 THEN
        SELECT '¡BENEFICIARIO REPETIDO!' INTO out_errormsg;
        LEAVE `sp_beneficiario_actualiza`;
    END IF;
    
    UPDATE beneficiarios SET nombre = in_nombre WHERE id = in_id;
END;
