DROP PROCEDURE IF EXISTS sp_usuario_ingreso;

CREATE PROCEDURE sp_usuario_ingreso (
    IN in_usuario VARCHAR(10),
    IN in_nombre VARCHAR(60),
    IN in_correo VARCHAR(120),
    IN in_contrasena VARCHAR(255),
    OUT out_errormsg VARCHAR(90)
)
/*
    Archivo:        sp_usuario_ingreso.sql
    Base de datos:  presupuesto
    Procedimiento:  sp_usuario_ingreso
    Propósito:      Ingresa la información de los usuarios y al ingreso procede 
                    a encriptar la contraseña.

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    04/04/2017  pgodoy      Creación del procedimiento
*/
`sp_usuario_ingreso`:
BEGIN
    IF (SELECT 1 FROM usuarios WHERE usuario LIKE in_usuario 
        OR correo LIKE in_correo) = 1 THEN
        SELECT '¡USUARIO/CORREO YA REGISTRADO!' INTO out_errormsg;
        LEAVE `sp_usuario_ingreso`;
    END IF;
    
    INSERT INTO usuarios (usuario, nombre, correo, contrasena)
    VALUES (in_usuario, in_nombre, in_correo, fn_hashpsw(in_contrasena));
END;


#Ingreso de Usuario
CALL sp_usuario_ingreso('pgodoyg', 'Pablo Godoy', 'pablodavid36@gmail.com', 'david2554', @mensaje);
SELECT @mensaje as MENSAJE;