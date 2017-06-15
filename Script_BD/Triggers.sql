use elearning2;

DELIMITER //
CREATE TRIGGER actualizar_nota_entrega
AFTER INSERT
   ON elearning2.Colaboracion FOR EACH ROW

BEGIN

   -- variable declarations --
   -- DECLARE vIdEntrega int(10); --
   DECLARE vNota float(4,2);
   
   
   -- find Entrega by Id --
   -- SELECT elearning2.Entrega.id_entrega INTO vIdEntrega; --
   SELECT elearning2.Entrega.nota INTO vNota FROM elearning2.Entrega where id_entrega = NEW.id_entrega;
   
   -- 
   set @csum := vNota;
   -- update nota de la Entrega  --
   UPDATE elearning2.Entrega
	SET nota= (@csum := @csum + NEW.nota)
	WHERE id_entrega=NEW.id_entrega

END;
DELIMITER ;

SELECT somevalue INTO myvar FROM mytable WHERE uid=1;
SELECT SUM(nota) FROM Colaboracion where id_entrega = NEW.id_entrega;