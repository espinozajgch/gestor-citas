SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `ventas`.`entrada_historico` ADD COLUMN `historico_id_historico` INT(10) UNSIGNED NOT NULL  AFTER `indice_tabla` , 
  ADD CONSTRAINT `fk_entrada_historico_historico1`
  FOREIGN KEY (`historico_id_historico` )
  REFERENCES `ventas`.`historico` (`id_historico` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_entrada_historico_historico1_idx` (`historico_id_historico` ASC) ;

ALTER TABLE `ventas`.`paciente` ADD COLUMN `historico_id_historico` INT(10) UNSIGNED NULL DEFAULT NULL  AFTER `estado_paciente` , 
  ADD CONSTRAINT `fk_paciente_historico1`
  FOREIGN KEY (`historico_id_historico` )
  REFERENCES `ventas`.`historico` (`id_historico` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD INDEX `fk_paciente_historico1_idx` (`historico_id_historico` ASC) ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
