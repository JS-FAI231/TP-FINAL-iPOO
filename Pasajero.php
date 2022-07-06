<?php
require_once "BaseDatos.php";
require_once "Viaje.php";

class Pasajero
{
    private $documento;          //clave primaria
    private $nombre;
    private $apellido;
    private $telefono;
    private $idviaje;            // clave foranea de la tabla Viaje
    private $objViaje;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->documento = "";
        $this->nombre = "";
        $this->apellido = "";
        $this->telefono = 0;
        $this->idviaje = 0;
        $this->objViaje = '';
    }

    public function cargar($documento, $nombre, $apellido, $telefono, $idviaje)
    {
        $this->documento = $documento;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->idviaje = $idviaje;
    }

    /**
     * FUNCIONES PARA SQL
     * Recupera los datos de un Pasajero por numeroDocumento
     * @param string $numeroDocumento
     * @return true en caso de encontrar los datos, false en caso contrario 
     */
    public function Buscar($numeroDocumento)
    {
        $base = new BaseDatos();
        $consultaPersona = "Select * from pasajero where rdocumento=" . $numeroDocumento;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) {
                    $this->setDocumento($numeroDocumento);

                    $this->setNombre($row2['pnombre']);
                    $this->setApellido($row2['papellido']);
                    $this->setTelefono($row2['ptelefono']);
                    $this->setIdviaje($row2['idviaje']);

                    $this->delegacion();
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = "")
    {
        $arregloPersona = null;
        $base = new BaseDatos();
        $consultaPersonas = "Select * from pasajero ";
        if ($condicion != "") {
            $consultaPersonas = $consultaPersonas . ' where ' . $condicion;
        }
        $consultaPersonas .= " order by papellido ";
        //echo $consultaPersonas;
       
        if ($base->Iniciar()) {
       
            if ($base->Ejecutar($consultaPersonas)) {
       
                $arregloPersona = array();
                while ($row2 = $base->Registro()) {

                    $a = $row2['rdocumento'];
                    $b = $row2['pnombre'];
                    $c = $row2['papellido'];
                    $d = $row2['ptelefono'];
                    $e = $row2['idviaje'];

                    $perso = new Pasajero();
                    $perso->cargar($a, $b, $c, $d, $e);
                    $perso->delegacion();
                    array_push($arregloPersona, $perso);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloPersona;
    }

    public function listarPax($condicion)
    {
        $arregloPersona = null;
        $base = new BaseDatos();
        $consultaPersonas = "Select * from pasajero ";
        if ($condicion != "") {
            $consultaPersonas = $consultaPersonas . ' where ' . $condicion;
        }
        $consultaPersonas .= " order by papellido ";
        //echo $consultaPersonas;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersonas)) {
                $arregloPersona = array();
                while ($row2 = $base->Registro()) {

                    $a = $row2['rdocumento'];
                    $b = $row2['pnombre'];
                    $c = $row2['papellido'];
                    $d = $row2['ptelefono'];
                    $e = $row2['idviaje'];
                    
                    $perso = new Pasajero();
                    $perso->cargar($a, $b, $c, $d, $e);
                    $perso->delegacion();
                    array_push($arregloPersona, $perso);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloPersona;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO pasajero(rdocumento, pnombre, papellido, ptelefono, idviaje) VALUES ('" . $this->getDocumento() . "','" . $this->getNombre() . "','" . $this->getApellido() . "','" . $this->getTelefono() . "','" . $this->getObjViaje()->getIdviaje() . "')";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        // $consultaModifica="UPDATE persona SET apellido='".$this->getApellido()."',nombre='".$this->getNombre()."'
        //                    ,email='".$this->getEmail()."' WHERE nrodoc=". $this->getNrodoc();
        $consultaModifica = "UPDATE pasajero 
        SET pnombre='" . $this->getNombre() .
            "',papellido='" . $this->getApellido() .
            "',ptelefono='" . $this->getTelefono() .
            "',idviaje='" . $this->getObjViaje()->getIdviaje() .
            "' WHERE rdocumento=" . $this->getDocumento();

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM pasajero WHERE rdocumento=" . $this->getDocumento();
            if ($base->Ejecutar($consultaBorra)) {
                $resp =  true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    /**SETTERS Y GETTERS */
    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param string $documento 
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre 
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido 
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param int $telefono 
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getIdviaje()
    {
        return $this->idviaje;
    }

    /**
     * @param string $idviaje 
     */
    public function setIdviaje($idviaje)
    {
        $this->idviaje = $idviaje;
    }

    /**
     * @return string
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * @param string $mensajeoperacion 
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * @return Viaje
     */
    public function getObjViaje()
    {
        return $this->objViaje;
    }

    /**
     * @param Viaje $objViaje
     */
    public function setObjViaje($objViaje)
    {
        $this->objViaje = $objViaje;
    }

    /**
     * Redefinicion del __toString()
     */
    public function __toString()
    {
        $a = $this->getDocumento();
        $b = $this->getNombre();
        $c = $this->getApellido();
        $d = $this->getTelefono();
        $e = "(".$this->getObjViaje()->getIdviaje().") ".$this->getObjViaje()->getDestino();
        return ("Nro Doc: " . $a . " Nombre: " . $b . " Apellido: " . $c . " Telefono: " . $d . " Destino: " . $e . "\n");
    }

    public function delegacion()
    {
        $obj = new Viaje();
        if ($obj->buscar($this->getIdviaje())) {
            $this->setObjViaje($obj);
        }else{
            echo "Error de delegacion Obj Viaje ".$this->getIdviaje();
            echo "\n";
        }

    }
}
