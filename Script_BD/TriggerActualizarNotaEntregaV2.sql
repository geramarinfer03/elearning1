use elearning2;

DELIMITER //
CREATE TRIGGER actualizar_nota_entrega
AFTER INSERT
   ON Colaboracion FOR EACH ROW

BEGIN

   -- variable declarations --
   DECLARE vNota float(5,2);
   DECLARE countColaboracion int;
   DECLARE vNotaColaboracion float(5,2);
   DECLARE vNotaAutoevaluacion float (5,2);
   
   -- find Nota Entrega by Id --
   SELECT nota INTO vNota FROM Entrega WHERE Entrega.id_entrega = NEW.id_entrega;
   SELECT COUNT(id_colaboracion) INTO countColaboracion  FROM Colaboracion WHERE Colaboracion.id_tipo_colaboracion = 2;
   SELECT SUM(nota) INTO vNotaColaboracion FROM Colaboracion WHERE Colaboracion.id_entrega = NEW.id_entrega AND Colaboracion.id_tipo_colaboracion = 2;
   SELECT nota INTO vNotaAutoevaluacion FROM Colaboracion WHERE Colaboracion.id_entrega = NEW.id_entrega AND Colaboracion.id_tipo_colaboracion = 1;
   
   -- 
   SET @cNota := vNota;
   -- update nota de la Entrega Colaborcion  --
   IF(NEW.id_tipo_colaboracion > 1) THEN
		SET @cNotaColaboracion := (vNotaColaboracion / countColaboracion);
		SET @cNota := @cNota + ((@cNotaColaboracion * 20) / 100);
	ELSE
		SET @cNota := @cNota + ((vNotaAutoevaluacion * 10) / 100);
	END IF;
   UPDATE entrega
	SET nota= @cNota
	WHERE id_entrega=NEW.id_entrega;

END; //

DELIMITER ;

SHOW TRIGGERS;