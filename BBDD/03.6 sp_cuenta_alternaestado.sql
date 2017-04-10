DROP PROCEDURE IF EXISTS sp_cuenta_alternaestado;

CREATE PROCEDURE sp_cuenta_alternaestado (
    IN in_id INT,
    IN in_usuario MEDIUMINT,
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_cuenta_alternaestado.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_cuenta_alternaestado
    Propósito:      Alterna el estado de la cuenta (activo/inactivo).

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    10/04/2017  pgodoy      Creación del procedimiento
*/
`sp_cuenta_alternaestado`:
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION BEGIN
        SELECT 'ERROR AL REINGRESAR LA INFORMACIÓN DE LA CUENTA' INTO out_errormsg;
        ROLLBACK;
    END;

    IF (SELECT 1 FROM cuentas WHERE id = in_id AND usuario_id = in_usuario) != 1 THEN
        SELECT '¡EL USUARIO SOLO PUEDE MODIFICAR SUS CUENTAS!' INTO out_errormsg;
        LEAVE `sp_cuenta_alternaestado`;
    END IF;

    IF (SELECT estado FROM cuentas WHERE id = in_id) = 1 THEN
        UPDATE cuentas SET estado = 0 WHERE id = in_id;
    ELSE 
        UPDATE cuentas SET estado = 1 WHERE id = in_id;
    END IF;
END;