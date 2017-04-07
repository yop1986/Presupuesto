DROP PROCEDURE IF EXISTS sp_secuencial;

CREATE PROCEDURE sp_secuencial (
    IN in_tabla VARCHAR(60),
    OUT out_secuencial INT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_secuencial.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_secuencial
    Propósito:      Toma el secuencial correspondiente de la tabla correlativos
                    y lo devuelve despues de aumentar en uno el valor del 
                    secuencial de la tabla indicada

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    05/04/2017  pgodoy      Creación del procedimiento
*/
`sp_secuencial`:
BEGIN
    SELECT secuencial INTO out_secuencial FROM correlativos 
    WHERE tabla LIKE in_tabla;

    IF (ROW_COUNT() < 1) THEN
        SELECT '¡NO EXISTE LA TABLA!' INTO out_errormsg;
        LEAVE `sp_secuencial`;
    END IF;
    
    UPDATE correlativos SET secuencial = secuencial + 1 WHERE tabla LIKE in_tabla;
END

#Ingreso de titulares
#call sp_secuencial('TABLA', @valor, @mensaje);
#SELECT @valor AS VALOR, @mensaje AS MENSAJE;