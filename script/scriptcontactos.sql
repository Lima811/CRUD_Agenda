/*TABLA USUARIOS_CONTACTOS */
CREATE TABLE UsuariosContactos (
    nIdPersonal SMALLINT NOT NULL AUTO_INCREMENT, 
    sNombre VARCHAR(200) NOT NULL, 
    dFecNacim DATE, 
    sSexo CHAR(1) DEFAULT 'F' NOT NULL COMMENT 'F O M', 
    nTipo SMALLINT NOT NULL COMMENT '1=admin 2=visualizador',
    CONSTRAINT usuariocontacto_pk PRIMARY KEY (nIdPersonal)
);

/*TABLA USUARIO*/
CREATE TABLE Usuario (
    nCveUsu SMALLINT NOT NULL AUTO_INCREMENT, 
    sPassword VARCHAR(16) NOT NULL, 
    nIdPersonal SMALLINT NOT NULL, 
    CONSTRAINT cveusuario_pk PRIMARY KEY (nCveUsu)
);

/*TABLA CONTACTOS */
CREATE TABLE Contactos (
    id_contacto INTEGER NOT NULL AUTO_INCREMENT, 
    nombreCompleto VARCHAR(200) NOT NULL, 
    direccion VARCHAR(50) NOT NULL, 
    telefono VARCHAR(10) NOT NULL, 
    email VARCHAR(40) NOT NULL, 
    id_visualizador SMALLINT NULL, 
    CONSTRAINT idcontacto_pk PRIMARY KEY (id_contacto)
);

/* Indice sobre id de usuariocontacto para evitar que un usuario se asocie a más de un usuario de contacto */
CREATE UNIQUE INDEX usuario_idx ON Usuario (nIdPersonal ASC);

/*Llaves foráneas*/
ALTER TABLE Usuario DROP FOREIGN KEY usuario_usuariocontacto;
ALTER TABLE Contactos DROP FOREIGN KEY usuarios_contactos;

ALTER TABLE Usuario 
ADD CONSTRAINT usuario_usuariocontacto FOREIGN KEY (nIdPersonal) 
REFERENCES UsuariosContactos(nIdPersonal) 
ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE Contactos 
ADD CONSTRAINT usuarios_contactos FOREIGN KEY (id_visualizador) 
REFERENCES UsuariosContactos(nIdPersonal) 
ON DELETE CASCADE ON UPDATE CASCADE;

/*Creación de usuario adminlima de base de datos y permisos*/
DROP USER IF EXISTS 'adminlima'@'localhost';
FLUSH PRIVILEGES; 
CREATE USER 'adminlima'@'localhost' IDENTIFIED BY 'limaglez';

/*Asignación de permisos*/
GRANT SELECT, INSERT, UPDATE, DELETE ON usuario TO adminlima;
GRANT SELECT, INSERT, UPDATE, DELETE ON usuarioscontactos TO adminlima;
GRANT SELECT, INSERT, UPDATE, DELETE ON contactos TO adminlima;
