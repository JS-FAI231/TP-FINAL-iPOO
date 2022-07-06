<?php
require_once "BaseDatos.php";

class Viaje{
    private $idviaje; 
    private $destino;
    private $cantmaxpasajeros;
    private $documento;
    private $idempresa;          //clave foranea Empresa
    private $numeroempleado;     //clave foranea Responsable
    private $importe;
    private $tipoAsiento;
    private $idayvuelta;    
    private $mensajeoperacion;

    private $objEmpresa;       //DELGACION
    private $objResponsable;   //DELGACION
    private $arr_Pasajeros;    //Pasajeros del viaje

    public function __construct(){
        $this->idviaje=0;
        $this->destino="";
        $this->cantmaxpasajeros=0;
        $this->documento="";
        $this->idempresa=0;         
        $this->numeroempleado=0;    
        $this->importe=0;
        $this->tipoAsiento="";
        $this->idayvuelta="";
        $this->objEmpresa=new Empresa();
        $this->objResponsable=new Responsable();  //numeroEmpleado
        $this->arr_Pasajeros=array();
    }
    

    public function cargar($idviaje,$destino,$cantmaxpasajeros,$documento,$idempresa,$numeroempleado,$importe,$tipoAsiento,$idayvuelta){
        $this->idviaje=$idviaje;
        $this->destino=$destino;
        $this->cantmaxpasajeros=$cantmaxpasajeros;
        $this->documento=$documento;
        $this->idempresa=$idempresa;
        $this->numeroempleado=$numeroempleado;
        $this->importe=$importe;
        $this->tipoAsiento=$tipoAsiento;
        $this->idayvuelta=$idayvuelta;
        
        $this->cargarPasajerosDelViaje();
        
    }

    
    /**
     * FUNCIONES PARA SQL
	 * Recupera los datos de un Viaje por numeroViaje
	 * @param string $numeroDocumento
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($numeroViaje){
		$base=new BaseDatos();
		$consultaPersona="Select * from viaje where idviaje=".$numeroViaje;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdViaje($numeroViaje);
                    $this->setDestino($row2['vdestino']);
					$this->setCantmaxpasajeros($row2['vcantmaxpasajeros']);
                    $this->setDocumento($row2['rdocumento']); 
                    $this->setIdempresa($row2['idempresa']);             
                    $this->setNumeroempleado($row2['rnumeroempleado']);  
                    $this->setImporte($row2['vimporte']);
                    $this->setTipoAsiento($row2['tipoAsiento']);
                    $this->setIdayvuelta($row2['idayvuelta']);
                                        
                    $this->delegacion();
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
		$consultaPersonas="Select * from viaje ";
		if ($condicion!=""){
		    $consultaPersonas=$consultaPersonas.' where '.$condicion;
		}
		$consultaPersonas.=" order by vdestino ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersonas)){				
				$arregloPersona= array();
				while($row2=$base->Registro()){
					
					$a=$row2['idviaje'];
					$b=$row2['vdestino'];
					$c=$row2['vcantmaxpasajeros'];

                    $d=$row2['rdocumento'];
                    $e=$row2['idempresa'];
                    $f=$row2['rnumeroempleado'];

                    $g=$row2['vimporte'];
                    $h=$row2['tipoAsiento'];
                    $i=$row2['idayvuelta'];
			
					$perso=new Viaje();
					$perso->cargar($a,$b,$c,$d,$e,$f,$g,$h,$i);
                    $perso->delegacion();

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
		$consultaInsertar="INSERT INTO viaje (idviaje, vdestino, vcantmaxpasajeros, rdocumento, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES ('".$this->getIdviaje()."','".$this->getDestino()."'
                ,'".$this->getCantmaxpasajeros()."','".$this->getDocumento()."'
                ,'".$this->getIdempresa()."','".$this->getNumeroempleado()."'
                ,'".$this->getImporte()."','".$this->getTipoAsiento()."'
                ,'".$this->getIdayvuelta()."')";
	
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
        $consultaModifica="UPDATE viaje 
        SET vdestino='".$this->getDestino().
        "',vcantmaxpasajeros='".$this->getCantmaxpasajeros().
        "',rdocumento='".$this->getDocumento().
        "',idempresa='".$this->getIdempresa().
        "',rnumeroempleado='".$this->getNumeroempleado().
        "',vimporte='".$this->getImporte().
        "',tipoAsiento='".$this->getTipoAsiento().
        "',idayvuelta='".$this->getIdayvuelta().
        "' WHERE idviaje=". $this->getIdviaje();

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
				$consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getIdviaje();
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
    public function getIdviaje(){
        return $this->idviaje;
    }

    /**
     * @param int $idviaje 
     */
    public function setIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }

    /**
     * @return string
     */
    public function getDestino(){
        return $this->destino;
    }

    /**
     * @param string $destino 
     */
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * @return int
     */
    public function getCantmaxpasajeros(){
        return $this->cantmaxpasajeros;
    }

    /**
     * @param int $cantmaxpasajeros 
     */
    public function setCantmaxpasajeros($cantmaxpasajeros){
        $this->cantmaxpasajeros = $cantmaxpasajeros;
    }

    /**
     * @return string
     */
    public function getDocumento(){
        return $this->documento;
    }

    /**
     * @param string $documento 
     */
    public function setDocumento($documento){
        $this->documento = $documento;
    }

    /**
     * @return int
     */
    public function getIdempresa(){
        return $this->idempresa;
    }

    /**
     * @param int $idempresa 
     */
    public function setIdempresa($idempresa){
        $this->idempresa = $idempresa;
    }

    /**
     * @return int
     */
    public function getNumeroempleado(){
        return $this->numeroempleado;
    }

    /**
     * @param int $numeroempleado 
     */
    public function setNumeroempleado($numeroempleado){
        $this->numeroempleado = $numeroempleado;
    }

    /**
     * @return float
     */
    public function getImporte(){
        return $this->importe;
    }

    /**
     * @param float $importe 
     */
    public function setImporte($importe){
        $this->importe = $importe;
    }

    /**
     * @return string
     */
    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }

    /**
     * @param string $tipoAsiento 
     */
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }

    /**
     * @return string
     */
    public function getIdayvuelta(){
        return $this->idayvuelta;
    }

    /**
     * @param string $idayvuelta 
     */
    public function setIdayvuelta($idayvuelta){
        $this->idayvuelta = $idayvuelta;
    }
    /**
     * @return mixed
     */
    public function getObjEmpresa(){
        return $this->objEmpresa;
    }

    /**
     * @param mixed $objEmpresa 
     */
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
        $this->setIdempresa($objEmpresa->getIdempresa());
    }

    /**
     * @return Responsable
     */
    public function getObjResponsable(){
        return $this->objResponsable;
    }

    /**
     * @param Responsable $objResponsable 
     */
    public function setObjResponsable($objResponsable){
        $this->objResponsable = $objResponsable;
        $this->setNumeroempleado($objResponsable->getNumeroEmpleado());
    }

    /**
     * @return array
     */
    public function getArr_Pasajeros(){
        return $this->arr_Pasajeros;
    }

    /**
     * @param array $arr_Pasajeros 
     */
    public function setArr_Pasajeros($arr_Pasajeros){
        $this->arr_Pasajeros = $arr_Pasajeros;
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
        $a=$this->getIdviaje();
        $b=$this->getDestino();
        $c=$this->getCantmaxpasajeros();

        $d=$this->getDocumento(); 

        $d1="";
        $arrPax=$this->getArr_Pasajeros();
        foreach ($arrPax as $objPax){
            $d1.=$objPax->__toString();
        }

        $e=$this->getIdempresa(); 
        $e1=$this->getObjEmpresa();//DELEGACION

        $f=$this->getNumeroempleado();
        $f1=$this->getObjResponsable(); //DELEGACION

        $g=$this->getImporte();
        $h=$this->getTipoAsiento();

        $i=$this->getIdayvuelta();

        $j=$this->lugaresDisponibles();

        return ("************************************************************\n".
        "Destino: ".$b.
        "  ID Viaje: ".$a."\n".
        "CantMaxPax: ".$c.
        "  Lugares Disp: ".$j.
        "  Importe: ".$g.
        "  TipoAsiento: ".$h.
        "  Ida y Vuelta: ".$i."\n".
        "*DATOS EMPRESA: ".$e1->__toString().
        "*DATOS RESPONSABLE: ".$f1->__toString().
        "*PASAJEROS: \n".$d1.
        "************************************************************\n");
    }


    /**OPERACIONES DE LA CLASE */
    public function losViajes(){
        $a=$this->getIdviaje();
        $b=$this->getDestino();
        $c=$this->getCantmaxpasajeros();

        $d=$this->getDocumento(); 

        $d1="";
        $arrPax=$this->getArr_Pasajeros();
        foreach ($arrPax as $objPax){
            $d1.=$objPax->__toString();
        }

        $e=$this->getIdempresa(); 
        $e1=$this->getObjEmpresa();//DELEGACION

        $f=$this->getNumeroempleado();
        $f1=$this->getObjResponsable(); //DELEGACION

        $g=$this->getImporte();
        $h=$this->getTipoAsiento();

        $i=$this->getIdayvuelta();

        return (
        "Destino: ".$b.
        "  CantMaxPax: ".$c.
        "  Importe: ".$g.
        "  TipoAsiento: ".$h.
        "  Ida y Vuelta: ".$i.
        "  ID Viaje: ".$a.
        "");
    }

    public function lugaresDisponibles(){
        $this->cargarPasajerosDelViaje();
        $cantidadPax=count($this->getArr_Pasajeros());
        $lugaresDisponibles=$this->getCantmaxpasajeros()-$cantidadPax;
        return $lugaresDisponibles;
    }


    /**DELEGACION */

    public function delegacion(){
        $this->cargarEmpresa();
        $this->cargarResponsable();
    }

    public function cargarEmpresa(){
        $obj=new Empresa();
        if ($obj->buscar($this->getIdempresa())){
            $this->setObjEmpresa($obj);
        }else{
            echo "Error de delegacion SetID-Empresa ".$this->getIdempresa();
            echo "\n";
        }
    }
    public function cargarResponsable(){
        $obj=new Responsable();
        if ($obj->buscar($this->getNumeroempleado())){
            $this->setObjResponsable($obj);
        }else{
            echo "Error de delegacion Set-Responsable ".$this->getNumeroempleado();
            echo "\n";
        }
    }
    
    public function cargarPasajerosDelViaje(){
        //hago un select en Pasajeros que me devuela todos los pasajeros de este viaje 
        //y los cargo en el array.
        $objPax=new Pasajero();
        //Hago listarPax con la condicion WHERE por parametro.
        $arrPax=$objPax->listarPax("pasajero.idviaje=".$this->getIdviaje());
        $this->setArr_Pasajeros($arrPax);
    }
    /**FIN DELEGACION */
    


    
}
