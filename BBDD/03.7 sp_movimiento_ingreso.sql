DROP PROCEDURE IF EXISTS sp_movimiento_ingreso;

CREATE PROCEDURE sp_movimiento_ingreso (
    IN in_cuenta INT,
    IN in_causa INT,
    IN in_beneficiario INT,
    IN in_monto NUMERIC(15,2),
    IN in_descripcion VARCHAR(90),
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_movimiento_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_movimiento_ingreso
    Propósito:      Realiza el ingreso de cada movimiento realizado a una cta
                    específica

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    05/04/2017  pgodoy      Creación del procedimiento
*/
`sp_movimiento_ingreso`:
BEGIN
    DECLARE w_tabla VARCHAR(30) DEFAULT 'movimientos';

    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        IF ISNULL(out_errormsg) THEN
            SELECT 'ERROR EL INGRESAR EL MOVIMIENTO' INTO out_errormsg;
        END IF;
        ROLLBACK;
    END;

    SET @w_causa_ingreso = 0,   # determina si la causa esta parametrizada como ingreso/egreso
        @w_cuenta_activo = 0,   # si la cuenta es activo/pasivo para el usuario
        @w_secuencial = 0;      # obtiene el utlimo secuencial para los movimientos

    IF (SELECT COUNT(id) FROM cuentas 
        WHERE id = in_cuenta AND usuario_id = in_usuario) = 0 THEN
        SELECT '¡LA CUENTA NO PERTENECE AL USUARIO LOGUEADO!' INTO out_errormsg;
        LEAVE `sp_movimiento_ingreso`;
    END IF;

    IF (in_monto <= 0) THEN
        SELECT '¡EL MONTO DEBE SER MAYOR A CERO!' INTO out_errormsg;
        LEAVE `sp_movimiento_ingreso`;
    END IF;

    SELECT @w_causa_ingreso := ingreso 
    FROM cl_causas 
    WHERE id = in_causa;

    SELECT @w_cuenta_activo := activo
    FROM cuentas AS C INNER JOIN cl_tipo_ctas AS TC
    WHERE C.tipo_id = TC.id AND C.id = 1;

    IF (@w_causa_ingreso = @w_cuenta_activo) THEN
        START TRANSACTION;
        
        CALL sp_secuencial(w_tabla, @w_secuencial, out_errormsg);
        UPDATE cuentas SET saldo = saldo + in_monto WHERE id = in_cuenta;

        INSERT INTO movimientos (cuenta_id, correlativo, causa_id, beneficiario_id, monto, descripcion, usuario_id)
        VALUES (in_cuenta, @w_secuencial, in_causa, in_beneficiario, in_monto, in_descripcion, in_usuario);

        COMMIT;
    ELSE
        IF (SELECT COUNT(id) FROM cuentas WHERE id = in_cuenta AND saldo >= in_monto) = 0 THEN 
            SELECT 'FONDOS INSUFICIENTES' INTO out_errormsg;
            LEAVE `sp_movimiento_ingreso`;
        END IF;

        START TRANSACTION;
    
        CALL sp_secuencial(w_tabla, @w_secuencial, out_errormsg);
        UPDATE cuentas SET saldo = saldo - in_monto WHERE id = in_cuenta;

        INSERT INTO movimientos (cuenta_id, correlativo, causa_id, beneficiario_id, monto, descripcion, usuario_id)
        VALUES (in_cuenta, @w_secuencial, in_causa, in_beneficiario, in_monto, in_descripcion, in_usuario);

        COMMIT;
    END IF;
END

#Ingreso de Movimientos
CALL sp_movimiento_ingreso(1, 2, 1, 10, 'prueba9', 1, @mensaje);
SELECT @mensaje as MENSAJE;