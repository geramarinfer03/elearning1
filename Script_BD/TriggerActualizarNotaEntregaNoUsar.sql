DELIMITER $$
CREATE TRIGGER actualizar_nota_entrega
AFTER INSERT
   ON elearning2.Colaboracion FOR EACH ROW

BEGIN

   UPDATE elearning2.Entrega
	SET nota= (SELECT SUM(nota)
			   FROM Colaboracion 
               WHERE id_entrega = NEW.id_entrega)
	WHERE id_entrega= NEW.id_entrega;

END; $$

DELIMITER ;

Show triggers