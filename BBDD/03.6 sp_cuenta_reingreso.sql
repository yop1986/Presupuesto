DROP PROCEDURE IF EXISTS sp_cuenta_reingreso;

CREATE PROCEDURE sp_cuenta_reingreso (
    IN in_id INT,
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
    Archivo:        sp_cuenta_reingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_cuenta_reingreso
    Propósito:      Permite corregir el ingreso la información inicial de las 
                    cuentas sobre las cuales se desea llevar el control.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    10/04/2017  pgodoy      Creación del procedimiento
*/
`sp_cuenta_reingreso`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        SELECT 'ERROR AL REINGRESAR LA INFORMACIÓN DE LA CUENTA' INTO out_errormsg;
        ROLLBACK;
    END;

    IF (SELECT 1 FROM cuentas WHERE id = in_id AND usuario_id = in_usuario) != 1 THEN
        SELECT '¡EL USUARIO SOLO PUEDE MODIFICAR SUS CUENTAS!' INTO out_errormsg;
        LEAVE `sp_cuenta_reingreso`;
    END IF;

    IF (SELECT COUNT(id) FROM movimientos WHERE cuenta_id = in_id) > 0 THEN 
        SELECT '¡NO SE PUEDE CORREGIR EL INGRESO DE UNA CUENTA CON MOVIMIENTOS!' INTO out_errormsg;
        LEAVE `sp_cuenta_reingreso`;
    END IF;

    IF (SELECT 1 FROM cuentas WHERE usuario_id = in_usuario 
        AND nombre LIKE in_nombre) = 1 THEN
        SELECT '¡NOMBRE DE LA CUENTA YA REGISTRADO PARA EL USUARIO!' INTO out_errormsg;
        LEAVE `sp_cuenta_reingreso`;
    END IF;

    IF (in_saldo < 0) THEN 
        SELECT '¡NO SE PERMITE UN SALDO MENOR A CERO!' INTO out_errormsg;
        LEAVE `sp_cuenta_reingreso`;
    END IF;
    
    UPDATE cuentas SET nombre = in_nombre, moneda_id = in_moneda, tipo_id = in_tipo,
        saldo = in_saldo, descripcion = in_descripcion, estado = in_estado WHERE id = in_id;
END;