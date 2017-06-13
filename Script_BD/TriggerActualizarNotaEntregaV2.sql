use elearning2;

DELIMITER //
CREATE TRIGGER actualizar_nota_entrega
AFTER INSERT
   ON colaboracion FOR EACH ROW

BEGIN

   -- variable declarations --
   DECLARE vNota float(4,2);
   DECLARE countColaboracion int;
   DECLARE countAutoevaluacion int;
   DECLARE vNotaColaboracion float(4,2);
   DECLARE vNotaAutoevaluacion float (4,2);
   
   -- find Nota Entrega by Id --
   SELECT nota INTO vNota FROM entrega WHERE id_entrega = NEW.id_entrega;
   SELECT COUNT(id_colaboracion) INTO countColaboracion  FROM colaboracion WHERE id_tipo_colaboracion = 1;
   SELECT COUNT(id_colaboracion) INTO countAutoevaluacion  FROM colaboracion WHERE id_tipo_colaboracion = 2;
   SELECT SUM(nota) INTO vNotaColaboracion FROM colaboracion WHERE id_entrega = NEW.id_entrega AND id_tipo_colaboracion = 1;
   SELECT SUM(nota) INTO vNotaAutoevaluacion FROM colaboracion WHERE id_entrega = NEW.id_entrega AND id_tipo_colaboracion = 2 ;
   
   -- 
   SET @cNota := vNota;
   -- update nota de la Entrega Autoevaluacion  --
   IF(NEW.id_tipo_colaboracion > 1) THEN
		SET @cNotaColaboracion := (vNotaColaboracion / countColaboracion);
		SET @cNota := @cNota + ((@cNotaColaboracion * 20) / 100);
	ELSE
		SET @cNotaAutoevaluacion := (vNotaAutoevaluacion / countAutoevaluacion);
		SET @cNota := @cNota + ((@cNotaAutoevaluacion * 10) / 100);
	END IF;
   UPDATE entrega
	SET nota= @cNota
	WHERE id_entrega=NEW.id_entrega;

END; //

DELIMITER ;

SHOW TRIGGERS;