# BBDD (cotejamiento):  presupuesto (utf8_spanish_ci)
# Usuario/Contraseña:   usr_persupuesto / X7dFQDnRIeAYQc9J

create table usuarios (
    id smallint unsigned not null auto_increment,
    nombre varchar(60) not null,
    correo varchar(150) not null,
    contrasena varchar(150) not null,
    creado datetime not null default current_timestamp,
    modificado datetime,
    activo boolean not null default true,
    rol enum('Administrador', 'Usuario') not null default 'Administrador',

    constraint usuario_pk_id primary key (id), 
    constraint usuario_unq_correo unique(correo)
);
#alter table usuarios modify column rol ENUM('Administrador', 'Usuario') not null DEFAULT 'Administrador';
#alter table usuarios add column activo boolean not null default true after modificado;

create table servicios (
    id tinyint unsigned not null auto_increment, 
    nombre varchar(30) not null, 

    constraint servicios_pk_id primary key (id)
);

create table servicio_usuarios (
    id mediumint unsigned not null auto_increment,
    descripcion varchar(60) not null, 
    servicio_id tinyint unsigned not null, 
    usuario_id smallint unsigned not null, 

    constraint srvusr_pk_id primary key (id), 
    constraint srvusr_unq_srvusr unique (servicio_id, usuario_id)
);

create table instituciones (
    id tinyint unsigned not null auto_increment,
    nombre varchar(60) not null,
    sitio varchar(150) not null,

    constraint instituciones_pk_id primary key (id), 
    constraint instituciones_unq_nombre unique (nombre)
);

create table tipo_cuentas (
    id tinyint unsigned not null auto_increment, 
    nombre varchar(60) not null, 
    activo boolean not null default true comment 'true: activo/false: pasivo',

    constraint tpcta_pk_id primary key (id),
    constraint tpcta_unq_nombre unique(nombre)
);

create table monedas (
    id tinyint unsigned not null auto_increment,
    codigo varchar(3) not null, 
    descripcion varchar(30) not null, 

    constraint monedas_pk_id primary key (id), 
    constraint monedas_unq_codigo unique (codigo)
);

create table cuentas (
    id mediumint unsigned not null auto_increment,
    nombre varchar(60) not null,
    saldo decimal(15,2) not null default 0,
    estado boolean not null default true comment 'true: activo/false: inactivo',
    moneda_id tinyint unsigned not null,
    tipo_cuenta_id tinyint unsigned not null,
    institucion_id tinyint unsigned not null,
    usuario_id smallint unsigned not null,

    constraint cuentas_pk_id primary key (id),
    constraint cuentas_unq_nombre unique (nombre),
    constraint cuentas_fk_moneda foreign key (moneda_id) references monedas(id),
    constraint cuentas_fk_tpcuentas foreign key (tipo_cuenta_id) references tipo_cuentas(id),
    constraint cuentas_fk_institucion foreign key (institucion_id) references instituciones(id),
    constraint cuentas_fk_usuario foreign key (usuario_id) references usuarios(id)
);
#alter table cuentas add column moneda_id tinyint unsigned not null after nombre;
#alter table cuentas add constraint cuentas_fk_moneda foreign key (moneda_id) references monedas(id);


### por revisar

-- movimientos