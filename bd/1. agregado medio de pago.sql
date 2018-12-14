SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `ventas`.`reserva_medica` DROP FOREIGN KEY `fk_reserva_medica_medio_contacto1` ;

ALTER TABLE `ventas`.`reserva_medica` CHANGE COLUMN `medio_contacto_id_mc` `medio_contacto_id_mc` INT(11) NULL DEFAULT NULL  , ADD COLUMN `metodos_pago_id_mp` INT(11) NULL DEFAULT NULL  AFTER `hora_fin` , 
  ADD CONSTRAINT `fk_reserva_medica_medio_contacto1`
  FOREIGN KEY (`medio_contacto_id_mc` )
  REFERENCES `ventas`.`medio_contacto` (`id_mc` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION, 
  ADD CONSTRAINT `fk_reserva_medica_metodos_pago1`
  FOREIGN KEY (`metodos_pago_id_mp` )
  REFERENCES `ventas`.`metodos_pago` (`id_mp` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_reserva_medica_metodos_pago1_idx` (`metodos_pago_id_mp` ASC) ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
