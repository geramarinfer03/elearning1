USE elearning2;

DROP TABLE IF EXISTS Process_Config;
CREATE TABLE Process_Config ( 
	Id_Process INT NOT NULL AUTO_INCREMENT ,
	Hora_Ejecucion TIME NOT NULL ,
	Fecha_Actualizacion DATETIME NOT NULL , 
	PRIMARY KEY (Id_Process) 
) ENGINE = InnoDB;

INSERT INTO Process_Config (Id_Process,	Hora_Ejecucion,	Fecha_Actualizacion) VALUES (NULL, '01:00:00', '2017-06-15 00:00:00');

DROP PROCEDURE IF EXISTS pr_update_process_config;
DELIMITER $$
CREATE PROCEDURE pr_update_process_config
(
	IN p_Hora_Ejecucion       TIME
)
 BEGIN
  	START TRANSACTION;
    	SET AUTOCOMMIT = 0;
		
		UPDATE	Process_Config
		SET		Hora_Ejecucion = p_Hora_Ejecucion,
				Fecha_Actualizacion = CURDATE()
		WHERE	Id_Process = 1;
	COMMIT;
 END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS pr_update_generate_certificate;
DELIMITER $$
CREATE PROCEDURE pr_update_generate_certificate()
 BEGIN
  	START TRANSACTION;
    	SET AUTOCOMMIT = 0;
		
		UPDATE	Matricula m 
				INNER JOIN Curso c ON
					m.Curso = c.Id_Curso
		SET		m.generarPDF = 1,
				m.fecha_creado = CURDATE()
		WHERE	m.promedio_final > 0
				AND m.generarPDF = 0
				AND c.Fecha_Final <= CURDATE();
	COMMIT;
 END $$
DELIMITER ;

SET GLOBAL event_scheduler = ON;

DROP EVENT Actualizar_Estado_PDF;
CREATE EVENT Actualizar_Estado_PDF ON SCHEDULE EVERY 1 DAY STARTS '2017-06-15 01:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL pr_update_generate_certificate;