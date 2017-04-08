DROP PROCEDURE IF EXISTS sp_causa_ingreso;

CREATE PROCEDURE sp_causa_ingreso (
    IN in_nombre VARCHAR(30),
    IN in_ingreso BIT,
    IN in_causa_padre INT,
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_causa_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_causa_ingreso
    Propósito:      Ingresar informacion a la tabla cl_causas, asegurandose de 
                    mantener consistente la causa de acuerdo al padre que la 
                    contiene.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    29/03/2017  pgodoy      Creación del procedimiento
*/
`sp_causa_ingreso`:
BEGIN
    SET @w_ingreso = 0;

    IF (SELECT 1 FROM cl_causas WHERE nombre LIKE in_nombre AND usuario_id = in_usuario) = 1 THEN
        SELECT '¡CAUSA YA REGISTRADA!' INTO out_errormsg;
        LEAVE `sp_causa_ingreso`;
    END IF;

    IF ISNULL(in_causa_padre) THEN 
        INSERT INTO cl_causas (nombre, ingreso, causa_id, usuario_id)
        VALUES (in_nombre, in_ingreso, NULL, in_usuario);
    ELSE
        SELECT @w_ingreso := ingreso
        FROM cl_causas WHERE id = in_causa_padre AND usuario_id = in_usuario;
        
        IF (@w_ingreso != in_ingreso) THEN 
            SELECT 'NO COINCIDEN LOS TIPOS DE CUENTA' INTO out_errormsg;
            LEAVE `sp_causa_ingreso`;
        END IF;

        INSERT INTO cl_causas (nombre, ingreso, causa_id, usuario_id)
        VALUES (in_nombre, in_ingreso, in_causa_padre, in_usuario);
    END IF;
END;

#Ingreso de Causas
CALL sp_causa_ingreso('Crédito', 1, NULL, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Débito', 0, NULL, 1, @mensaje);
SELECT @mensaje;

CALL sp_causa_ingreso('Sueldo', 1, 1, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Capitalización de intereses', 1, 1, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Depósito a cuenta', 1, 1, 1, @mensaje);
SELECT @mensaje;

CALL sp_causa_ingreso('Servicios', 0, 2, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Agua', 0, 6, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Luz Apto. A', 0, 6, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Luz Apto. B', 0, 6, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('Telefono casa', 0, 6, 1, @mensaje);
SELECT @mensaje;
CALL sp_causa_ingreso('IUSI', 0, 6, 1, @mensaje);
SELECT @mensaje;

#select * from cl_causas;
