<?php
require_once "BaseDatos.php";

class Responsable{
    private $numeroEmpleado;  //autoincrement clave primaria
    private $numeroLicencia;
    private $nombre;
    private $apellido;
    private $mensajeoperacion;
    
    public function __construct(){
        $this->numeroEmpleado=0;
        $this->numeroLicencia=0;
        $this->nombre="";
        $this->apellido="";
    }

    public function cargar($numeroEmpleado,$numeroLicencia,$nombre,$apellido){
        $this->numeroEmpleado=$numeroEmpleado;
        $this->numeroLicencia=$numeroLicencia;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
    }

    /**
     * FUNCIONES PARA SQL
	 * Recupera los datos de un Responsable por numeroEmpleado
	 * @param int $numeroEmpleado
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($numeroEmpleado){
		$base=new BaseDatos();
		$consultaPersona="Select * from responsable where rnumeroempleado=".$numeroEmpleado;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setNumeroEmpleado($numeroEmpleado);

                    $this->setNumeroLicencia($row2['rnumerolicencia']);
					$this->setNombre($row2['rnombre']);
                    $this->setApellido($row2['rapellido']);
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
		$consultaPersonas="Select * from responsable ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.$condicion;
		}
		$consultaPersonas.=" order by rnombre ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($row2=$base->Registro()){
					
					$a=$row2['rnumeroempleado'];
					$b=$row2['rnumerolicencia'];
					$c=$row2['rnombre'];
                    $d=$row2['rapellido'];
			
					$perso=new Responsable();
					$perso->cargar($a,$b,$c,$d);
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
		$consultaInsertar="INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) VALUES ('".$this->getNumeroLicencia()."','".$this->getNombre()."','".$this->getApellido()."')";
	
		if($base->Iniciar()){
			if($base->Ejecutar($consultaInsertar)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
			}
		}else{
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		// $consultaModifica="UPDATE persona SET apellido='".$this->getApellido()."',nombre='".$this->getNombre()."'
        //                    ,email='".$this->getEmail()."' WHERE nrodoc=". $this->getNrodoc();
        $consultaModifica="UPDATE responsable 
        SET rnumerolicencia='".$this->getNumeroLicencia().
        "',rnombre='".$this->getNombre().
        "',rapellido='".$this->getApellido().
        "' WHERE rnumeroempleado=". $this->getNumeroEmpleado();

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
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNumeroEmpleado();
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
     * @return mixed
     */
    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
    }

    /**
     * @param mixed $numeroEmpleado 
     */
    public function setNumeroEmpleado($numeroEmpleado){
        $this->numeroEmpleado = $numeroEmpleado;
    }

    /**
     * @return mixed
     */
    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    /**
     * @param mixed $numeroLicencia 
     */
    public function setNumeroLicencia($numeroLicencia){
        $this->numeroLicencia = $numeroLicencia;
    }

    /**
     * @return mixed
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * @param mixed $nombre 
     */
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * @param mixed $apellido 
     */
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    /**
     * @param mixed $mensajeoperacion 
     */
    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * Redefinicion del __toString()
     */
    public function __toString(){
        $a=$this->getNumeroEmpleado();
        $b=$this->getNumeroLicencia();
        $c=$this->getNombre();
        $d=$this->getApellido();
        return ("Nombre: ".$c." Apellido: ".$d.
        " Licencia: ".$b." Nro Empleado: ".$a."\n");
    }
}

