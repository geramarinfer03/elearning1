USE elearning2;

DELIMITER //
DROP TRIGGER IF EXISTS actualizar_promedio_insert//
CREATE TRIGGER actualizar_promedio_insert
AFTER INSERT 
	ON Entrega FOR EACH ROW

BEGIN

	-- variable declarations --
	DECLARE vValorTarea FLOAT(4,2);	
	DECLARE vPromedio FLOAT(4,2);

	SELECT porcentaje INTO vValorTarea FROM Tarea WHERE Tarea.id_tarea = NEW.id_tarea;
	SELECT promedio_final INTO vPromedio FROM Matricula WHERE Matricula.id_matricula = NEW.id_matricula;

	UPDATE Matricula SET promedio_final = (vPromedio + (NEW.nota/100) * vValorTarea) WHERE Matricula.id_matricula = NEW.id_matricula;


END; //
DELIMITER ;






DELIMITER //
DROP TRIGGER IF EXISTS actualizar_promedio_update//
CREATE TRIGGER actualizar_promedio_update
AFTER UPDATE 
	ON Entrega FOR EACH ROW

BEGIN

	-- variable declarations --
	DECLARE vValorTarea FLOAT(4,2);	
	DECLARE vPromedio FLOAT(4,2);    
	DECLARE vViejaNota FLOAT(4,2);
    
	SELECT porcentaje INTO vValorTarea FROM Tarea WHERE Tarea.id_tarea = NEW.id_tarea;
	SELECT promedio_final INTO vPromedio FROM Matricula WHERE Matricula.id_matricula = NEW.id_matricula;
	
	SET vViejaNota := (OLD.nota/100) * vValorTarea;    
    
	UPDATE Matricula SET promedio_final = (vPromedio - vViejaNota + (NEW.nota/100) * vValorTarea) WHERE Matricula.id_matricula = NEW.id_matricula;
	

END; //
DELIMITER ;