DROP PROCEDURE IF EXISTS sp_cuenta_ingreso;

CREATE PROCEDURE sp_cuenta_ingreso (
    IN in_nombre VARCHAR(30), 
    IN in_moneda INT,
    IN in_tipo INT,
    IN in_saldo NUMERIC(15,2),
    IN in_descripcion VARCHAR(255),
    IN in_estado BIT, -- Activo (1); Inactivo (0)
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_cuenta_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_cuenta_ingreso
    Propósito:      Ingresar información inicial de las cuentas sobre las cuales
                    se desea llevar el control.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    05/04/2017  pgodoy      Creación del procedimiento
*/
`sp_cuenta_ingreso`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        SELECT 'ERROR AL INGRESAR LA CUENTA' INTO out_errormsg;
        ROLLBACK;
    END;

    IF (SELECT 1 FROM cuentas WHERE usuario_id = in_usuario 
        AND nombre LIKE in_nombre) = 1 THEN
            SELECT '¡NOMBRE YA REGISTRADO!' INTO out_errormsg;
            LEAVE `sp_cuenta_ingreso`;
    END IF;

    IF (in_saldo < 0) THEN 
        SELECT '¡NO SE PERMITE UN SALDO MENOR A CERO!' INTO out_errormsg;
        LEAVE `sp_cuenta_ingreso`;
    END IF;
    
    INSERT INTO cuentas (nombre, tipo_id, moneda_id, saldo, descripcion, estado, usuario_id)
    VALUES (in_nombre, in_tipo, in_moneda, in_saldo, in_descripcion, in_estado, in_usuario);
END

#Ingreso de Cuentas
CALL sp_cuenta_ingreso('Monetaria 9560', 1, 1, 0, 'Cuenta Principal', 1, 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_cuenta_ingreso('Ahorro 8983', 1, 2, 0, 'Cuenta de Ahorro Mensual', 1, 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_cuenta_ingreso('Ahorro 3313', 1, 2, 45.32, 'Cuenta de Ahorro Saldos', 1, 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_cuenta_ingreso('Fondo de Retiro', 1, 3, 6506.67, 'Fondo de reitro con colaboración mensual', 1, 1, @mensaje);
SELECT @mensaje as MENSAJE;

CALL sp_cuenta_ingreso('Prestamo', 1, 5, 18819.68, 'Prestamo Fiduciario 2016', 1, 1, @mensaje);
SELECT @mensaje as MENSAJE;