DROP PROCEDURE IF EXISTS sp_moneda_ingreso;

CREATE PROCEDURE sp_moneda_ingreso (
    IN in_simbolo VARCHAR(3),
    IN in_nombre VARCHAR(30),
    IN in_pais VARCHAR(30),
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_moneda_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_moneda_ingreso
    Propósito:      Ingresar informacion a la tabla cl_monedas, asegurandose que 
                    la moneda ingresada sea única.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    29/03/2017  pgodoy      Creación del procedimiento
*/
`sp_moneda_ingreso`:
BEGIN
    IF (SELECT 1 FROM cl_monedas WHERE simbolo LIKE in_simbolo 
        OR nombre LIKE in_nombre) = 1 THEN
        SELECT '¡MONEDA O SIMBOLO REPETIDO!' INTO out_errormsg;
        LEAVE `sp_moneda_ingreso`;
    END IF;
    
    INSERT INTO cl_monedas (simbolo, nombre, pais)
    VALUES (in_simbolo, in_nombre, in_pais);
END;

#Ingreso de cl_monedas
CALL sp_moneda_ingreso('GTQ', 'Quetzal', 'Guatemala', @mensaje);
SELECT @mensaje as MENSAJE;