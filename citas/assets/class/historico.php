<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historico
 *
 * @author RM
 */
class historico {
    //put your code here
    
    public static function crear_historico($tipo_historico, $codigo_historico, $return_id = false){
        $bd = connection::getInstance()->getDb();
        $consulta = "INSERT INTO historico (tipo_historico, codigo_historico)
            VALUES (?,?)";
        
        $comando = $bd->prepare($consulta);
        $resultado = $comando->execute(array($tipo_historico, $codigo_historico));
        
        if ($resultado){
            if ($return_id){
                return $bd->lastInsertId();
            }
            else{
                return 1;
            }
            
        }
        else{
            return 0;
        }
    }
    
    public static function obtener_id_historico_paciente ($id_paciente){
        $bd = connection::getInstance()->getDb();
        //Consulta para obtener los dias feriados
        $sql = "SELECT `historico_id_historico` 
            FROM `paciente` 
            WHERE `id_paciente`=".$id_paciente;
        $pdo = $bd->prepare($sql);        
        $pdo->execute();        
        $resultados = $pdo->fetchAll(PDO::FETCH_ASSOC);
        //print_r($resultados);        
        return $resultados[0]["historico_id_historico"];        
    }
    
    public static function agregar_entrada($id_historico, $tipo, $descripcion, $nivel, $tabla = false, $id_relacionado = false){
        $bd = connection::getInstance()->getDb();
        //Por ahora nos quedaremos con la insercion basica, sin agregar tabla o id
        $consulta = "INSERT INTO entrada_historico 
            (tipo_entrada, historico_id_historico, nivel_entrada, descripcion_entrada)
            VALUES (?,?,?,?)";
        
        $comando = $bd->prepare($consulta);
        $resultado = $comando->execute(array($tipo, $id_historico, $nivel, $descripcion));
        
        if ($resultado){
            return 1;
        }
        else{
            return 0;
        }
    }
    
    public static function cantidad_entradas(){
        
    }
}
