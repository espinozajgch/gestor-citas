<?php
//MySQL PDO
require_once 'mysql-login.php';

class connection{
	/**
	** Unica Instanciade la clase
	*/
	private static $db = null;

	/**
	**Instancia del PDO
	*/	
	private static $pdo;

	final private function __construct()
	{
		try{
			//Crear nueva conexion PDO
			self::getDb();
		} catch(Exception $e){
			//Manejo de excepciones
			echo "Ha ocurrido un error ",$e->getMessage(), "\n";
		}
	}

	public static function getInstance(){
		if(self::$db === null){
			self::$db = new self();
		}
		return self::$db;
	}

	/**
	*Crear una nueva conexion PDO basada
	*en los datos de conexion
	*@return PDO Objeto PDO
	*/

	public function getDb()
	{
		if(self::$pdo == null){
			try {
				//self::
				$pdo = new PDO(
				'mysql:dbname=' . DATABASE .
                ';host=' . HOSTNAME .
                ';',	
				USERNAME,
				PASSWORD,				
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);
/*
				$pdo = new PDO(
				'mysql:host=' . HOSTNAME . ';',	
				USERNAME,
				PASSWORD,				
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);*/

				//self::$pdo;
				//var_dump(self::$pdo);

				//Habilitar excepciones
				//self::
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $pdo;
			
			} 
			catch (PDOException $ex){
		     	
				echo "Ha ocurrido un error en la PDO ",$ex->getMessage(), "\n";
				die();
		    }
			catch (Exception $e) {
				
				echo "Ha ocurrido un error ",$e->getMessage(), "\n";
				die();
			}
		}		
	}

/**
*EVITA LA CLONACION DEL OBJETO
*/

final protected function __clone(){
	trigger_error("Operacion Invalida: No puede clonar una
		Instancia de ". get_class($this) ." class ", E_USER_ERROR);
}

public function __wakeup()
{
  trigger_error("No puede deserializar una instancia de ". get_class($this) ." class.", E_USER_ERROR );
}

function _destructor(){
	self::$pdo = null;
}


/*Conectando
	try{
		$conn = new PDO('mysql:host='.host ='.$hostname.';dbname='.$database.', $username, $password);
	}
	catch(PDOException $e){
		die();
	}


public static function getDate(){
			$bd = Conexion::getPrototipo();
			$con = $bd->ejecutarQuery("SELECT NOW() as f");
			$con = $con->fetch();
			return $con['f'];
		}*/


}
?>