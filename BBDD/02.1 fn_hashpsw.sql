DROP FUNCTION IF EXISTS fn_hashpsw;

CREATE FUNCTION fn_hashpsw (
    in_password VARCHAR(60)
)
/*
    Archivo:        fn_hashpsw.sql
    Base de datos:  presupuesto
    Procedimiento:  fn_hashpsw
    Propósito:      Encripta la contraseña de los usuarios utilizando SHA256

    --- --- --- --- --- --- --- --- Historial --- --- --- --- --- --- --- --- 
    Fecha       Usuario     Comentario
    04/04/2017  pgodoy      Creación del procedimiento
*/
RETURNS VARCHAR(255) RETURN
( SHA2(in_password, 256) )