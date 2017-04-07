DROP PROCEDURE IF EXISTS sp_moneda_actualiza;

CREATE PROCEDURE sp_moneda_actualiza (
    IN in_id INT,
    IN in_simbolo VARCHAR(3),
    IN in_nombre VARCHAR(30),
    IN in_pais VARCHAR(30),
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_moneda_actualiza.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_moneda_actualiza
    Propósito:      Actualiza información de una moneda que no sea utilizada.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    07/04/2017  pgodoy      Creación del procedimiento
*/
`sp_moneda_actualiza`:
BEGIN
    IF (SELECT COUNT(id) FROM cuentas WHERE moneda_id = in_id) > 0 THEN 
        SELECT '¡NO PUEDE MODIFICAR UNA MONEDA YA UTILIZADA!' INTO out_errormsg;
        LEAVE `sp_moneda_actualiza`;
    END IF;

    IF (SELECT 1 FROM cl_monedas 
        WHERE id != in_id AND (simbolo LIKE in_simbolo OR nombre LIKE in_nombre)) = 1 THEN
        SELECT '¡MONEDA O SIMBOLO REPETIDO!' INTO out_errormsg;
        LEAVE `sp_moneda_actualiza`;
    END IF;
    
    UPDATE cl_monedas SET simbolo = in_simbolo, nombre = in_nombre, pais = in_pais WHERE id = in_id;
END;
