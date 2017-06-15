USE elearning2;

DELIMITER //
DROP TRIGGER IF EXISTS actualizar_evaluacion//
CREATE TRIGGER actualizar_evaluacion
AFTER INSERT 
	ON Tarea FOR EACH ROW

BEGIN

	-- variable declarations --
	DECLARE vCurrentEvaluation FLOAT(4,2);

	SELECT evaluado INTO vCurrentEvaluation FROM Curso WHERE id_curso = NEW.id_curso;

	UPDATE Curso SET evaluado = (vCurrentEvaluation + NEW.porcentaje) WHERE id_curso = NEW.id_curso;


END; //
DELIMITER ;