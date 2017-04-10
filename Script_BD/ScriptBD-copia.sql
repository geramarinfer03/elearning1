create database elearning2;

use elearning2;


CREATE TABLE Rol(
id_rol INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
estado INT (1) NOT NULL
);

/*rol en Usuario.. */
CREATE TABLE Usuario (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(250) NOT NULL,
email VARCHAR(250) NOT NULL,
password VARCHAR(60) NOT NULL,
id_rol INT(10) UNSIGNED NOT NULL,
genero VARCHAR(10) NOT NULL,
pais VARCHAR(100) NOT NULL,
fecha_ultimo_ingreso datetime NOT NULL DEFAULT now(),
ip VARCHAR(12) NOT NULL,
os  VARCHAR (10) NOT NULL,
navegador VARCHAR (20) NOT NULL,
lenguaje VARCHAR(10),
remember_token varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
created_at timestamp NOT NULL DEFAULT now(),
updated_at timestamp NOT NULL DEFAULT now(),
FOREIGN KEY (id_rol) REFERENCES Rol(id_rol) 
);

CREATE TABLE Tipo_Recurso (
id_tipo_recurso INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL
);


CREATE TABLE Curso (
id_curso INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
duracion INT(10) NOT NULL,
fecha_inicio DATETIME NOT NULL,
fecha_final DATETIME NOT NULL,
estado INT (1) NOT NULL
);

/*UN curso tiene varias semanas -- agregue secuencia*/
CREATE TABLE Semana (
id_semana INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tema VARCHAR(30) NOT NULL,
visibl INT(1) NOT NULL,
estado INT (1) NOT NULL,
curso  INT (10) UNSIGNED NOT NULL,
secuencia INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (curso) REFERENCES Curso(id_curso) 
);



CREATE TABLE Recurso (
id_recurso INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
url VARCHAR(255),
tipo_recurso INT(10) UNSIGNED NOT NULL,
recurso_padre INT(10) UNSIGNED NOT NULL,
visibl INT (1) NOT NULL,
secuencia INT(10) NOT NULL,
notas VARCHAR(100) NOT NULL,
estado INT (1) NOT NULL,
semana INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (semana) REFERENCES Semana(id_semana),
FOREIGN KEY (tipo_recurso) REFERENCES Tipo_Recurso(id_tipo_recurso),
FOREIGN KEY (rol) REFERENCES Rol(id_rol)
);

/* /*NO se para que funciona
CREATE TABLE Recurso_Rol(
id_recurso_rol INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
recurso INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
estado INT(1) NOT NULL,
FOREIGN KEY (recurso) REFERENCES Recurso(id_recurso),
FOREIGN KEY (rol) REFERENCES Rol(id_rol) 
);
*/

/* El usuario va a tener el rol*/
/*
CREATE TABLE Usuario_Rol(
id_usuario_rol INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
usuario INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
estado INT(1) NOT NULL,
FOREIGN KEY (usuario) REFERENCES Usuario(id_usuario),
FOREIGN KEY (rol) REFERENCES Rol(id_rol) 
);*/

/* /*NO se para que funciona
CREATE TABLE Curso_Rol(
id_curso_rol INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
curso INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (curso) REFERENCES Curso(id_curso),
FOREIGN KEY (rol) REFERENCES Rol(id_rol) 
);
*/

/*Campo Rol dentro de matricula, para saber el rol que desempeña
el usuario en ese curso: Se puede acceder mas facilm cuales son los 
profesores, moderadores y estudiantes de un curso. Un Usuario-Profesor
puede estar en un curso como estudiante, y en otro como profesor*/

CREATE TABLE Matricula(
id_matricula INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
periodo INT(10) NOT NULL,
ano Date NOT NULL,
curso INT(10) UNSIGNED NOT NULL,
usuario INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
fecha_matricula DATETIME NOT NULL,
FOREIGN KEY (curso) REFERENCES Curso(id_curso),
FOREIGN KEY (usuario) REFERENCES Usuario(id),
FOREIGN KEY (rol) REFERENCES Rol(id_rol)
);



insert into Tipo_Recurso(nombre)
values
('Pagina'),
('Sección'),
('Etiqueta'),
('Texto'),
('Enlace'),
('Archivo')
;


insert into Curso(nombre, duracion, fecha_inicio, fecha_final, estado)
values
('Programacion Web', 5, '2016-05-14 12:00:00', '2017-01-10 00:00:00', 1),
('Administracion de Proyectos', 7, '2017-10-12 12:00:00', '2018-04-01 00:00:00', 1)
;


insert into Semana(tema, visible, estado, curso, secuencia)
values
('PHP y bases de datos', 1, 1, 1,1),
('PHP Framework Laravel', 1, 1, 1,2),
('Planificacion inicial', 1, 1, 2,1)
;

insert into Recurso (nombre, url,tipo_recurso,recurso_padre,visibl,secuencia,notas,estado,semana)
values
('Tema 1: Objetivos', null, 3, 0, 1, 1, 'etiqueta', 1, 1),
('Tema 1: Instalación', null, 2, 0, 1, 2, 'pdf instalacion', 1, 1),
('textoEntrada', 'Temas relacionados a este curso', 4, 0, 1, 3, 'texto', 1, 1);

insert into Rol (nombre,estado)
values
('Administrador',1),
('Editor',1),
('Profesor',1),
('Moderador',1),
('Estudiante',1);

insert into Usuario(nombre,email, password, id_rol, genero, pais,fecha_ultimo_ingreso,ip, os, navegador, lenguaje)
values
('Dario Rios Navarro', 'admin', 'admin', 1, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'),
('Jose Marin Fernandez', 'geramarinfer', 'root', 2, 'masculino', 'Colombia', now(), '172.13.24.1', 'Linux', 'Chrome', 'es');



DELIMITER //
CREATE PROCEDURE getUsuarios() 
  BEGIN
    SELECT nombre,email, password, rol, genero, pais,fecha_ultimo_ingreso,ip, os, navegador, lenguaje from usuario; 
  END//
  DELIMITER ;
  
  
DELIMITER //
CREATE PROCEDURE getUsuario(IN identificacion_in varchar(30)) 
  BEGIN
    SELECT nombre,email, password, rol, genero, pais,fecha_ultimo_ingreso,ip, os, navegador, lenguaje from usuario
    where identificacion = identificacion_in; 
  END//
  DELIMITER ;
  

  
  DELIMITER //
  CREATE PROCEDURE insertarUsuario(IN nombre_in VARCHAR(250), IN email_in VARCHAR(30), 
			password_in varchar(30), IN genero_in VARCHAR(10), pais_in VARCHAR(100),
            fecha_ult_ingre_in datetime, ip_in VARCHAR(12), os_in VARCHAR (10), navegador_in VARCHAR (20), lenguaje_in VARCHAR(10) ) 
  BEGIN
    INSERT INTO usuario (nombre,email, password, rol, genero, pais,fecha_ultimo_ingreso,ip, os, navegador, lenguaje) 
			VALUES (nombre_in, email_in, password_in, 5, genero_in, pais_in, fecha_ult_ingre_in, ip_in, os_in, navegador_in, lenguaje_in );
  END//
  DELIMITER ;



/*------------------------------------------------*/



DROP TABLE Matricula;
DROP TABLE Curso_Rol;
DROP TABLE Usuario_Rol;
DROP TABLE Recurso_Rol;
DROP TABLE Recurso;
DROP TABLE Semana;
DROP TABLE Curso;
DROP TABLE Tipo_Recurso;
DROP TABLE Rol;
DROP TABLE Usuario;














