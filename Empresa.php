<?php
require_once "BaseDatos.php";

class Empresa{
    private $idEmpresa; //autoincrement clave primaria
    private $nombre;
    private $direccion;
    private $mensajeoperacion;
    
    public function __construct(){
        $this->idEmpresa=0;
        $this->nombre="";
        $this->direccion="";
    }

    public function cargar($idEmpresa,$nombre,$direccion){
        $this->idEmpresa=$idEmpresa;
        $this->nombre=$nombre;
        $this->direccion=$direccion;
    }
    
    
    /**
     * FUNCIONES PARA SQL
	 * Recupera los datos de una empresa por idEmpresa
	 * @param int $idEmpresa
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idEmpresa){
		$base=new BaseDatos();
		$consultaPersona="Select * from empresa where idempresa=".$idEmpresa;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdEmpresa($idEmpresa);
					$this->setNombre($row2['enombre']);
					$this->setDireccion($row2['edireccion']);
					$resp= true;
				}				
		 	}else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }else{
	 		$this->setmensajeoperacion($base->getError());
		 }		
		 return $resp;
	}

    public function listar($condicion=""){
	    $arregloPersona = null;
		$base=new BaseDatos();
		$consultaPersonas="Select * from empresa ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.$condicion;
		}
		$consultaPersonas.=" order by enombre ";
		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona=array();
				while($row2=$base->Registro()){
					
					$a=$row2['idempresa'];
					$b=$row2['enombre'];
					$c=$row2['edireccion'];
									
					$perso=new Empresa();
					$perso->cargar($a,$b,$c);
					array_push($arregloPersona,$perso);
				}
		 	}else {
	 			$this->setmensajeoperacion($base->getError());
			}
		 }else{
	 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arregloPersona;
	}

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO empresa (enombre, edireccion) VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";
		//$consultaInsertar="INSERT INTO empresa (enombre, edireccion) VALUES ({$this->getNombre()},{$this->getDireccion()})";
		//echo ($consultaInsertar);
		if($base->Iniciar()){
			//echo('inicio');
			if($base->Ejecutar($consultaInsertar)){
				//echo('ejecuto');
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				//echo('error 1');
			}
		}else{
			$this->setmensajeoperacion($base->getError());
			//echo('error 2');
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		// $consultaModifica="UPDATE persona SET apellido='".$this->getApellido()."',nombre='".$this->getNombre()."'
		//                    ,email='".$this->getEmail()."' WHERE nrodoc=". $this->getNrodoc();

		 $consultaModifica="UPDATE empresa 
         SET enombre='".$this->getNombre().
         "',edireccion='".$this->getDireccion().
         "' WHERE idempresa=". $this->getIdEmpresa();
		
		 //$consultaModifica="UPDATE empresa 
        //SET enombre={$this->getNombre()},edireccion={$this->getDireccion()} WHERE idempresa={$this->getIdEmpresa()}";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
			}
		}else{
				$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
				//$consultaBorra="DELETE FROM empresa WHERE idempresa={$this->getIdEmpresa()}";
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
					$this->setmensajeoperacion($base->getError());					
				}
		}else{
			$this->setmensajeoperacion($base->getError());
		}
		return $resp; 
	}
    
    /**SETTERS Y GETTERS */
    /**
     * @return int
     */
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }

    /**
     * @param int $idEmpresa 
     */
    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    /**
     * @return string
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param string $nombre 
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getDireccion(){
        return $this->direccion;
    }

    /**
     * @param string $direccion 
     */
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    /**
     * @return string
     */
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    /**
     * @param string $mensajeoperacion 
     */
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * Redefinicion del __toString()
     */
    public function __toString(){
        $a=$this->getIdEmpresa();
        $b=$this->getNombre();
        $c=$this->getDireccion();

        return ("Nombre: ".$b." Direccion: ".$c." ID Empresa: ".$a."\n");
    }
}
?>