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
estado INT (1) NOT NULL,
evaluado FLOAT(4,2) UNSIGNED NOT NULL
);

/*UN curso tiene varias semanas -- agregue secuencia*/
CREATE TABLE Semana (
id_semana INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tema VARCHAR(30) NOT NULL,
visible INT(1) NOT NULL,
estado INT (1) NOT NULL,
curso  INT (10) UNSIGNED NOT NULL,
secuencia INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (curso) REFERENCES Curso(id_curso) 
);



CREATE TABLE Recurso (
id_recurso INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(150) NOT NULL,
url VARCHAR(255),
tipo_recurso INT(10) UNSIGNED NOT NULL,
recurso_padre INT(10) UNSIGNED NOT NULL,
visibl INT (1) NOT NULL,
secuencia INT(10) NOT NULL,
notas VARCHAR(255),
estado INT (1) NOT NULL,
semana INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (semana) REFERENCES Semana(id_semana),
FOREIGN KEY (tipo_recurso) REFERENCES Tipo_Recurso(id_tipo_recurso),
FOREIGN KEY (rol) REFERENCES Rol(id_rol)
);


CREATE TABLE Matricula(
id_matricula INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
periodo INT(10) NOT NULL,
ano Date NOT NULL,
curso INT(10) UNSIGNED NOT NULL,
usuario INT(10) UNSIGNED NOT NULL,
rol INT(10) UNSIGNED NOT NULL,
fecha_matricula DATETIME NOT NULL,
promedio_final FLOAT(4,2) UNSIGNED NOT NULL,
url VARCHAR(255),
FOREIGN KEY (curso) REFERENCES Curso(id_curso),
FOREIGN KEY (usuario) REFERENCES Usuario(id),
FOREIGN KEY (rol) REFERENCES Rol(id_rol)
);

CREATE TABLE Tarea(
id_tarea INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_recurso INT(10) UNSIGNED NOT NULL,
id_curso INT(10) UNSIGNED NOT NULL,
fech_limit_entrega DATETIME NOT NULL,
fech_limit_evaluacion DATETIME NOT NULL,
porcentaje FLOAT(4,2) UNSIGNED NOT NULL,
FOREIGN KEY (id_recurso) REFERENCES Recurso(id_recurso),
FOREIGN KEY (id_curso) REFERENCES Curso(id_curso)
);


CREATE TABLE Formulario(
id_formulario INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_tarea INT(10) UNSIGNED NOT NULL,
url VARCHAR(255),
totalPuntos INT(10) UNSIGNED NOT NULL,
FOREIGN KEY (id_tarea) REFERENCES Tarea(id_tarea)
);

CREATE TABLE Entrega(
id_entrega INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_tarea INT(10) UNSIGNED NOT NULL,
id_usuario INT(10) UNSIGNED NOT NULL,
id_matricula INT(10) UNSIGNED NOT NULL,
url VARCHAR(255) NOT NULL,
nota FLOAT(4,2) UNSIGNED NOT NULL,
FOREIGN KEY (id_tarea) REFERENCES Tarea(id_tarea),
FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
FOREIGN KEY (id_matricula) REFERENCES Matricula(id_matricula)
);

CREATE TABLE Tipo_Colaboracion(
id_tipo_colaboracion INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
descripcion VARCHAR(150) NOT NULL
);

CREATE TABLE Colaboracion(
id_colaboracion INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_usuario_califica INT(10) UNSIGNED NOT NULL,
id_tipo_colaboracion INT(10) UNSIGNED NOT NULL,
id_entrega INT(10) UNSIGNED NOT NULL,
id_formulario INT(10) UNSIGNED NOT NULL,
respuestas JSON,
nota FLOAT(4,2) UNSIGNED NOT NULL,
comentario NVARCHAR(255),
FOREIGN KEY (id_usuario_califica) REFERENCES Usuario(id),
FOREIGN KEY (id_tipo_colaboracion) REFERENCES Tipo_Colaboracion(id_tipo_colaboracion),
FOREIGN KEY (id_entrega) REFERENCES Entrega(id_entrega),
FOREIGN KEY (id_formulario) REFERENCES Formulario(id_formulario)
);


insert into Tipo_Recurso(nombre)
values
('Pagina'),
('Sección'),
('Etiqueta'),
('Texto'),
('Enlace'),
('Archivo'),
('Tarea')
;


insert into Curso(nombre, duracion, fecha_inicio, fecha_final, estado, evaluado)
values
('Programacion Web', 2, '2017-01-14 12:00:00', '2017-06-10 00:00:00', 1, 0),
('Administracion de Proyectos', 3, '2017-10-12 12:00:00', '2018-04-01 00:00:00', 1, 0),
('Ingenieria en Sistemas', 2, '2017-10-12 12:00:00', '2018-04-01 00:00:00', 1, 0)
;



insert into Semana(tema, visible, estado, curso, secuencia)
values
('PHP y bases de datos', 1, 1, 1,1),
('PHP Framework Laravel', 1, 1, 1,2),
('Planificacion inicial', 1, 1, 2,1),
('Reuniones Efectivas', 1, 1, 2,2),
('PMBOK', 1, 1, 2,3),
('Levantamiento Requerimientos', 1, 1, 3,1),
('Casos de Flujo', 1, 1, 3,2);

insert into Rol (nombre,estado)
values
('Administrador',1),
('Editor',1),
('Profesor',1),
('Moderador',1),
('Estudiante',1);

insert into Recurso (nombre, url,tipo_recurso,recurso_padre,visibl,secuencia,notas,estado,semana,rol)
values
('Tema 1: Objetivos', null, 3, 0, 1, 1, 'etiqueta', 1, 1, 5),
('Tema 1: Instalación', null, 2, 0, 1, 2, 'pdf instalacion', 1, 1, 5),
('textoEntrada', 'Temas relacionados a este curso', 4, 0, 1, 3, 'texto', 1, 1, 5);


insert into Usuario(nombre,email, password, id_rol, genero, pais,fecha_ultimo_ingreso,ip, os, navegador, lenguaje)
values
/*  Tipo Administrador Password: admin1234   Usuario: admin@example.com  */ 
('Dario Rios Navarro', 'admin@example.com', '$2y$10$U1Y3Px3NbJhdJh7v1x8U7ueXlgWhkP2trvOzAmENUfViVjlN2SNa6', 1, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'), 
/*  Tipo Editor Password: editor1234   Usuario: editor@example.com */ 
('Editor Sistema', 'editor@example.com', '$2y$10$vy8cNNNa47r1ABwiAULnJuiKdAjGKFGwKyxKw0P0HdUiu51r.a89y', 2, 'femenino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'),
/*  Tipo Profesor Password: profesor1234   Usuario: profesor@example.com */ 
('Profesor Sistema', 'profesor@example.com', '$2y$10$/HhiJPw8.HYZ1MyeGkK.2uzl1gcBE26atan9rvWHA9YG0PF.clbKW', 3, 'femenino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'),
/*  Tipo Moderador Password: moderador1234   Usuario: moderador@example.com */ 
('Moderador Sistema', 'moderador@example.com', '$2y$10$ll0p0xH0BtPcTfAAPgard..k4jTsF59.P5GSOvAbfOAG53F2rg1Hm', 4, 'femenino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'),
/*  Tipo Estudiante Password: estudiante1234   Usuario: estudiante@example.com */ 
('Estudiante Sistema', 'estudiante@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'femenino', 'Costa Rica', now(), '192.168.1.1', 'Windows', 'Firefox', 'es'),

('Estudiante Uno', 'estudiante1@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es'),

('Estudiante Dos', 'estudiante2@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es'),

('Estudiante Tres', 'estudiante3@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es'),

('Estudiante Cuatro', 'estudiante4@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es'),

('Estudiante Cinco', 'estudiante5@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es'),

('Estudiante Seis', 'estudiante6@example.com', '$2y$10$qP5VcIVXeeg9ppIbvBuWveMaLa52iocF2Jc3Mhll8d6XwUNuDO9Fu', 5, 'masculino', 'Costa Rica', now(), '192.168.1.1', 'Linux', 'Chrome', 'es');












