<?php
require_once "BaseDatos.php";
require_once "Empresa.php";
require_once "Responsable.php";
require_once "Viaje.php";
require_once "Pasajero.php";
//require_once "_TestCarga.php";

menuPrincipal();



function menuPrincipal()
{
    do {
        $respuesta = selectionarOpcion();
        switch ($respuesta) {
            case 1:
                menuEmpresas();
                break;
            case 2:
                menuResponsables();
                break;
            case 3:
                menuViajes();
                break;
            case 4:
                menuPasajeros();
                break;
            case 5:
                break;
            case 9:
                borrarDatosMySql();
                break;
        }
    } while ($respuesta != 0);
}
function selectionarOpcion()
{
    $opcionValida = true;
    $opcion = 0;
    do {
        echo "\n";
        echo "MAIN - TPO FINAL" . "\n";
        echo "****************\n";
        echo "1) EMPRESAS." . "\n";
        echo "2) RESPONSABLES ." . "\n";
        echo "3) VIAJES." . "\n";
        echo "4) PASAJEROS." . "\n";
        echo "\n";
        echo "9) Borrar Datos de mySQL.\n";
        echo "0) Salir." . "\n";
        echo "\n";
        echo "Ingrese una opcion: ";

        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "\nOpcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}




/**SubMenu EMPRESA */
function menuEmpresas()
{
    do {
        $respuesta = menuEmpresasOP();
        switch ($respuesta) {
            case 1:
                altaEmpresas();
                break;
            case 2:
                listaEmpresas();
                break;
            case 3:
                buscarEmpresa();
                break;
            case 4:
                modificarEmpresa();
                break;
            case 5:
                eliminarEmpresa();
                break;
        }
    } while ($respuesta != 0);
}
function menuEmpresasOP()
{
    $opcionValida = true;
    $opcion = 0;
    do {
        echo ("\nMENU EMPRESAS" . "\n");
        echo ("*************\n");
        echo ("1) Alta Empresa\n");
        echo ("2) Listar Empresas\n");
        echo ("3) Buscar Empresa\n");
        echo ("4) Modificar Empresa\n");
        echo ("5) Eliminar Empresa\n");
        echo ("\n");
        echo ("0) Atras\n");
        echo ("\n");
        echo ("Ingrese una opcion: ");

        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "\nOpcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}
/**FIN SubMenu EMPRESA */

/**SubMenu RESPONSABLES */
function menuResponsables()
{
    do {
        $respuesta = menuResponsablesOP();
        switch ($respuesta) {
            case 1:
                altaResponsables();
                break;
            case 2:
                listaResponsables();
                break;
            case 3:
                buscarResponsables();
                break;
            case 4:
                modificarResponsables();
                break;
            case 5:
                eliminarResponsables();
                break;
        }
    } while ($respuesta != 0);
}
function menuResponsablesOP()
{
    $opcionValida = true;
    $opcion = 0;
    do {
        echo "\n";
        echo "INGRESE UNA OPCION - RESPONSABLES" . "\n";
        echo "*****************************\n";
        echo "1) Alta Responsable." . "\n";
        echo "2) Listar Responsables." . "\n";
        echo "3) Buscar Responsable." . "\n";
        echo "4) Modificar Responsable." . "\n";
        echo "5) Eliminar Responsable." . "\n";
        echo "\n";
        echo "0) Atras." . "\n";
        echo ("Ingrese una opcion: ");
        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "\nOpcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}
/**FIN SubMenu RESPONSABLES */

/**SubMenu VIAJE */
function menuViajes()
{
    do {
        $respuesta = menuViajesOP();
        switch ($respuesta) {
            case 1:
                altaViaje();
                break;
            case 2:
                listaViajes();
                break;
            case 3:
                buscarViaje();
                break;
            case 4:
                modificarViaje();
                break;
            case 5:
                eliminarViaje();
                break;
            case 6:
                mostrarLugaresDisponibles();
                break;
            case 7:
                mostrarViajesConPax();
                break;
            case 8:
                venderViaje();
                break;
            case 9:
                mostrarViajesConLugaresDisponibles();
                break;
        }
    } while ($respuesta != 0);
}
function menuViajesOP()
{
    $opcionValida = true;
    $opcion = 0;
    do {
        echo "\n";
        echo "INGRESE UNA OPCION - VIAJES" . "\n";
        echo "*****************************\n";
        echo "1) Alta Viaje." . "\n";
        echo "2) Listar Viajes." . "\n";
        echo "3) Buscar (por clave numerica)." . "\n";
        echo "4) Modificar (por clave numerica)." . "\n";
        echo "5) Eliminar (por clave numerica)." . "\n";
        echo "\n";
        echo "6) Lugares disponibles en un viaje\n";
        echo "7) Mostrar Viajes con PAX\n";
        echo "8) Vender Viaje\n";
        echo "9) Mostrar Viajes con Lugares disponibles.\n";
        echo "\n";
        echo "0) Atras" . "\n";
        echo ("Ingrese una opcion: ");

        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "\nOpcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}
/**FIN SubMenu VIAJE */

/**SubMenu PASAJERO */
function menuPasajeros()
{
    do {
        $respuesta = menuPasajerosOP();
        switch ($respuesta) {
            case 1:
                altaPasajerosTestBD();
                break;
            case 2:
                ListaPasajeros();
                break;
            case 3:
                buscarPasajero();
                break;
            case 4:
                modificarPasajero();
                break;
            case 5:
                eliminarPasajero();
                break;
        }
    } while ($respuesta != 0);
}
function menuPasajerosOP()
{
    $opcionValida = true;
    $opcion = 0;
    do {
        echo "\n";
        echo "INGRESE UNA OPCION - PASAJEROS" . "\n";
        echo "*****************************\n";
        echo "1) Alta Pasajero (TEST BaseDatos)." . "\n";
        echo "2) Listar Pasajeros." . "\n";
        echo "3) Buscar (por DNI)." . "\n";
        echo "4) Modificar (por DNI)." . "\n";
        echo "5) Eliminar (por DNI)." . "\n";
        echo "\n";
        echo "0) Atras" . "\n";
        echo ("Ingrese una opcion: ");
        $opcion = trim(fgets(STDIN));

        $opcionValida = ($opcion >= 0 && $opcion <= 10);
        if (!$opcionValida) {
            echo "\nOpcion NO Valida." . "\n";
        }
    } while (!$opcionValida);
    return $opcion;
}
/**FIN SubMenu PASAJERO */





/******************************************************************** */

function altaEmpresas()
{
    echo ("Ingrese Nombre: ");
    $auxNombre = trim(fgets(STDIN));
    echo ("Ingrese Direccion: ");
    $auxDireccion = trim(fgets(STDIN));

    $empresa = new Empresa();
    $empresa->setNombre($auxNombre);
    $empresa->setDireccion($auxDireccion);

    if ($empresa->insertar()) {
        echo "\nLa empresa se cargo con exito\n";
    } else {
        echo $empresa->getMensajeoperacion() . "\n";
    }
}
function altaResponsables()
{

    echo ("Ingrese Nombre: ");
    $auxNombre = trim(fgets(STDIN));
    echo ("Ingrese Apellido: ");
    $auxApellido = trim(fgets(STDIN));
    echo ("Ingrese Numero Licencia: ");
    $auxLic = trim(fgets(STDIN));

    $obj = new Responsable();
    $obj->setNumeroLicencia($auxLic);
    $obj->setNombre($auxNombre);
    $obj->setApellido($auxApellido);

    if ($obj->insertar()) {
        echo ("\nSe agrego un Responsable con exito\n");
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function altaViaje()
{
    $obj = new Viaje();

    echo ("Ingrese Destino: ");
    $destino = trim(fgets(STDIN));
    if (existeDestino($destino)) {
        echo "\nERROR: El destino " . $destino . " ya existe...";
    } else {
        echo ("Ingrese Numero de Viaje: ");
        $idviaje = (int)(trim(fgets(STDIN)));
        echo ("Ingrese CantMax Pax: ");
        $cantmaxpasajeros = (int)(trim(fgets(STDIN)));
        $documento = 0;

        if (delegacionEmpresa($obj, "alta")) {
            if (delegacionResponsable($obj, "alta")) {
                echo ("Ingrese Importe: ");
                $importe = (float)(trim(fgets(STDIN)));
                echo ("Ingrese Tipo Asiento (CAMA / SEMICAMA): ");
                $tipoAsiento = trim(fgets(STDIN));
                echo ("Ingrese Ida y Vuelta (SI/NO): ");
                $idayvuelta = trim(fgets(STDIN));


                $obj->setIdviaje($idviaje);
                $obj->setDestino($destino);
                $obj->setCantmaxpasajeros($cantmaxpasajeros);
                $obj->setDocumento($documento);  //PAX
                $obj->setImporte($importe);
                $obj->setTipoAsiento($tipoAsiento);
                $obj->setIdayvuelta($idayvuelta);


                if ($obj->insertar()) {
                    echo "\nEl Viaje se cargo con exito\n";
                } else {
                    if (strpos($obj->getMensajeoperacion(), "1452") > 0) {
                        echo "\nERROR 1451: No se puede CREAR UN VIAJE. No existe el codigo de Responsable o de Empresa.\n";
                    } elseif (strpos($obj->getMensajeoperacion(), "1062") > 0) {
                        echo "\nERROR 1062: No se puede CREAR UN VIAJE.\n";
                    } else {
                        echo $obj->getMensajeoperacion();
                        echo ("\nFallo en el Alta\n");
                    }
                }
            } else {
                echo "El ID Responsable no puede estar vacio.\n";
            }
        } else {
            echo "El ID Empresa no puede estar vacio.\n";
        }
    }
}
function delegacionEmpresa($objViaje, $modo)
{
    //Pido ID Empresa
    $exitoDelegacionEmpresa = false;
    echo ("Ingrese ID Empresa (Vacio para no modificar): ");
    $idempresa = (int)(trim(fgets(STDIN)));
    if ($idempresa != 0) {
        $objEmpresa = new Empresa();
        if ($objEmpresa->buscar($idempresa)) {
            $objViaje->setObjEmpresa($objEmpresa);
            $exitoDelegacionEmpresa = true;
        } else {
            echo "El ID Empresa no existe.\n";
        }
    } else {
        if ($modo == "modificacion") {
            $exitoDelegacionEmpresa = true;
        }
    }
    return $exitoDelegacionEmpresa;
}
function delegacionResponsable($objViaje, $modo)
{
    //Pido ID Resp.
    $exitoDelegacionResponsable = false;
    echo ("Ingrese ID Responsable (Vacio para no modificar): ");
    $numeroempleado = (int)(trim(fgets(STDIN)));
    if ($numeroempleado != 0) {
        $objResponsable = new Responsable();
        if ($objResponsable->buscar($numeroempleado)) {
            $objViaje->setObjResponsable($objResponsable);
            $exitoDelegacionResponsable = true;
        } else {
            echo "El ID Responsable no existe.\n";
        }
    } else {
        if ($modo == "modificacion") {
            $exitoDelegacionResponsable = true;
        }
    }
    return $exitoDelegacionResponsable;
}

function existeDestino($destino)
{
    $exito = false;
    $obj = new Viaje();
    $condicion = "vdestino='" . $destino . "'";
    $exito = ($arr = $obj->listar($condicion));
    return $exito;
}
function mostrarLugaresDisponibles()
{
    echo ("Ingrese Numero de Viaje: ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Viaje();
    if ($obj->buscar($clave)) {
        echo "Disponibles: " . $obj->lugaresDisponibles() . " de " . $obj->getCantmaxpasajeros() . "\n";
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Viaje clave " . $clave . "\n";
    }
}
function mostrarViajesConPax()
{
    $obj = new Viaje();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            if (count($arr[$i]->getArr_Pasajeros()) > 0) {
                echo ($arr[$i]);
            }
            //echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function venderViaje()
{
    $checkViaje = false;
    $checkPasajero = false;
    $exito = false;

    echo ("Ingrese ID Viaje: ");
    $auxIdViaje = (int)(trim(fgets(STDIN)));
    $objViaje = new Viaje();
    if ($objViaje->buscar($auxIdViaje)) {
        $checkViaje = true;
        echo ("Ingrese DNI Pasajero: ");
        $auxDni = trim(fgets(STDIN));
        $objPasajero = new Pasajero();
        if ($objPasajero->buscar($auxDni)) {
            $checkPasajero = true;
        } else {
            echo ("El pasajero con DNI: " . $auxDni . " no existe. Ingrese Datos...\n");
            if ($objPasajero = altaPasajero($objViaje, $auxDni)) {
                $checkPasajero = true;
            }
        }
    } else {
        echo ("El viaje " . $auxIdViaje . " no existe.\n");
    }


    if ($checkViaje && $checkPasajero) {
        if (!existePasajeroEnViaje($objViaje, $auxDni)) {
            if ($objViaje->lugaresDisponibles() > 0) {
                //La venta consiste en asignarle al pasajero el IdViaje.
                echo "Vendiendo el pasaje...\n";
                $arrPasajeros = $objViaje->getArr_Pasajeros();
                array_push($arrPasajeros, $objPasajero);

                //Modifico el Viaje en la Base de datos
                if ($objViaje->modificar()) {
                    //Agrego el nuevo Pax a la base de datos.
                    if ($objPasajero->insertar()) {
                        echo "\nEl pasajero se cargo con exito\n";
                        echo "Se asigno correctamente el PAX al este VIAJE...\n";
                        if ($objViaje->buscar($auxIdViaje)) {
                            $objViaje->cargarPasajerosDelViaje();
                            echo ($objViaje);
                        }
                        $exito = true;
                    } else {
                        if (strpos($objPasajero->getMensajeoperacion(), "1062") > 0) {
                            echo "\nERROR 1062: DNI " . $objPasajero->getDocumento() . " YA EXISTENTE. No se puede agregar el mismo Pasajero.\n";
                        } elseif (strpos($objPasajero->getMensajeoperacion(), "1452") > 0) {
                            echo "\nERROR 1451: No se puede CREAR UN PASAJERO con IDVIAJE inexistente.\n";
                        } else {
                            echo $objPasajero->getMensajeoperacion();
                            echo ("\nFallo en el Alta\n");
                        }
                    }
                } else {
                    echo $objPasajero->getMensajeoperacion();
                    echo ("\n.Fallo la asignacion del Viaje a este PAX\n");
                }
            } else {
                echo ("No hay lugares disponibles en este viaje.\n");
            }
        } else {
            echo "El pasajero ya existe en este viaje.\n";
        }
    } else {
        echo "No Existe el IDViaje o no existe el pasajero.\n";
    }

    return $exito;
}
function altaPasajero($objViaje, $auxDni)
{

    echo ("Ingrese Nombre: ");
    $aux1 = trim(fgets(STDIN));
    echo ("Ingrese Apellido: ");
    $aux2 = trim(fgets(STDIN));
    echo ("Ingrese Telefono (Solo Numeros): ");
    $aux3 = (int)(trim(fgets(STDIN)));

    $objPax = new Pasajero();
    $objPax->setDocumento($auxDni);
    $objPax->setNombre($aux1);
    $objPax->setApellido($aux2);
    $objPax->setTelefono($aux3);

    $objPax->setObjViaje($objViaje);
    $objPax->setIdviaje($objViaje->getIdviaje());

    return $objPax;
}

function existePasajeroEnViaje($objViaje, $auxDni)
{
    $encontrado = false;
    $arrPax = $objViaje->getArr_Pasajeros();
    $i = 0;
    while ($i < count($arrPax) && !$encontrado) {
        $objPax = $arrPax[$i];
        if ($objPax->getDocumento() == $auxDni) {
            $encontrado = true;
        }
        $i++;
    }
    return $encontrado;
}
function mostrarViajesConLugaresDisponibles()
{
    $obj = new Viaje();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]->lugaresDisponibles() > 0) {
                echo ($arr[$i]);
            }
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}

function altaPasajerosTestBD()
{
    echo ("Ingrese DNI: ");
    $aux0 = trim(fgets(STDIN));
    echo ("Ingrese Nombre: ");
    $aux1 = trim(fgets(STDIN));
    echo ("Ingrese Apellido: ");
    $aux2 = trim(fgets(STDIN));
    echo ("Ingrese Telefono (Solo Numeros): ");
    $aux3 = (int)(trim(fgets(STDIN)));
    echo ("Ingrese ID Viaje: ");
    $aux4 = trim(fgets(STDIN));

    $obj = new Pasajero();
    $obj->setDocumento($aux0);
    $obj->setNombre($aux1);
    $obj->setApellido($aux2);
    $obj->setTelefono($aux3);
    $obj->setIdviaje($aux4);

    if ($obj->insertar()) {
        echo "\nEl pasajero se cargo con exito\n";
    } else {
        if (strpos($obj->getMensajeoperacion(), "1062") > 0) {
            echo "\nERROR 1062: DNI " . $aux0 . " YA EXISTENTE. No se puede agregar el mismo Pasajero.\n";
        } elseif (strpos($obj->getMensajeoperacion(), "1452") > 0) {
            echo "\nERROR 1451: No se puede CREAR UN PASAJERO con IDVIAJE inexistente.\n";
        } else {
            echo $obj->getMensajeoperacion();
            echo ("\nFallo en el Alta\n");
        }
    }
}




/******************************************************************** */

function listaEmpresas()
{
    $obj = new Empresa();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            echo ($arr[$i]);
            echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function listaResponsables()
{
    $obj = new Responsable();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            echo ($arr[$i]);
            echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function listaViajes()
{
    $obj = new Viaje();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            echo ($arr[$i]);
            echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function ListaPasajeros()
{
    $obj = new Pasajero();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            echo ($arr[$i]);
            echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
}
function misViajes()
{
    $obj = new Viaje();
    if ($arr = $obj->listar()) {
        for ($i = 0; $i < count($arr); $i++) {
            echo ($arr[$i]->losViajes());
            echo "\n";
        }
    } else {
        echo $obj->getMensajeoperacion() . "\n";
    }
    echo "\n";
}

/********************************************************************* */
function buscarEmpresa()
{
    echo ("Ingrese Clave de Empresa: ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Empresa();
    if ($obj->buscar($clave)) {
        echo ($obj);
        echo "\n";
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra la Empresa de clave " . $clave . "\n";
    }
}
function buscarResponsables()
{
    echo ("Ingrese NumeroEmpleado de Responsable: ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Responsable();
    if ($obj->buscar($clave)) {
        echo ($obj);
        echo "\n";
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Responsable de clave " . $clave . "\n";
    }
}
function buscarViaje()
{
    echo ("Ingrese Numero de Viaje: ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Viaje();
    if ($obj->buscar($clave)) {
        $obj->cargarPasajerosDelViaje();
        echo ($obj);
        echo "\n";
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Viaje clave " . $clave . "\n";
    }
}
function buscarPasajero()
{
    echo ("Ingrese DNI del Pasajero (Solo numeros) : ");
    $clave = trim(fgets(STDIN));

    $obj = new Pasajero();
    if ($obj->buscar($clave)) {
        echo ($obj);
        echo "\n";
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Pasajero de clave " . $clave . "\n";
    }
}


/********************************************************************* */
function modificarEmpresa()
{
    echo ("Ingrese Clave de Empresa: ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Empresa();
    if ($obj->buscar($clave)) {

        echo ("Ingrese NUEVO Nombre: ");
        $auxNombre = trim(fgets(STDIN));
        echo ("Ingrese NUEVA Direccion: ");
        $auxDireccion = trim(fgets(STDIN));

        $obj->setNombre($auxNombre);
        $obj->setDireccion($auxDireccion);

        if ($obj->modificar()) {
            $obj->buscar($clave);
            echo ("\n.Nuevos Valores de " . $obj . "\n");
        } else {
            $obj->getMensajeoperacion();
            echo ("\n.Fallo la actualizacion\n");
        }
    } else {
        $obj->getMensajeoperacion();
        echo "No se encuentra la Empresa de clave " . $clave . "\n";
    }
}
function modificarResponsables()
{
    $obj = new Responsable();
    echo ("Ingrese NumeroEmpleado de Responsable: ");
    $clave = (int)trim(fgets(STDIN));

    if ($obj->buscar($clave)) {
        echo ("Ingrese NUEVA Licencia: ");
        $auxLic = trim(fgets(STDIN));
        echo ("Ingrese NUEVO Nombre: ");
        $auxNombre = trim(fgets(STDIN));
        echo ("Ingrese NUEVO Apellido: ");
        $auxApellido = trim(fgets(STDIN));


        $obj->setNumeroLicencia($auxLic);
        $obj->setNombre($auxNombre);
        $obj->setApellido($auxApellido);

        if ($obj->modificar()) {
            $obj->buscar($clave);
            echo ("\n.Nuevos Valores de " . $obj . "\n");
        } else {
            echo $obj->getMensajeoperacion();
            echo ("\n.Fallo la actualizacion\n");
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Reponsable de clave " . $clave . "\n";
    }
}
function modificarViaje()
{
    //$exitoDelegacionEmpresa = false;
    //$exitoDelegacionResponsable = false;
    $exitoDelegacion = false;

    misViajes();
    $obj = new Viaje();
    echo ("Ingrese Numero de Viaje: ");
    $clave = (int)(trim(fgets(STDIN)));

    if ($obj->buscar($clave)) {

        $exitoDelegacionEmpresa = delegacionEmpresa($obj, "modificacion");
        $exitoDelegacionResponsable = delegacionResponsable($obj, "modificacion");

        $exitoDelegacion = $exitoDelegacionEmpresa && $exitoDelegacionResponsable;

        if ($exitoDelegacion) {
            echo ("Ingrese Importe: (Vacio para no modificar): ");
            $aux6 = (float)(trim(fgets(STDIN)));
            if ($aux6 != 0) {
                $obj->setImporte($aux6);
            }
            echo ("Ingrese Tipo Asiento (CAMA / SEMICAMA) (Vacio para no modificar): ");
            $aux7 = trim(fgets(STDIN));
            if ($aux7 != "") {
                $obj->setTipoAsiento($aux7);
            }
            echo ("Ingrese Ida y Vuelta (SI/NO) (Vacio para no modificar): ");
            $aux8 = trim(fgets(STDIN));
            if ($aux8 != "") {
                $obj->setIdayvuelta($aux8);
            }
            echo ("Ingrese CantMax Pax (Vacio para no modificar): ");
            $cantmaxpasajeros = (int)(trim(fgets(STDIN)));
            if ($cantmaxpasajeros > 0) {
                $cantidadPax = count($obj->getArr_Pasajeros());
                if (($cantmaxpasajeros - $cantidadPax) >= 0) {
                    $obj->setCantmaxpasajeros($cantmaxpasajeros);
                } else {
                    echo "La cantMax no puede ser menor a " . $cantidadPax . "\n";
                }
            }
            echo "Confima Modificacion? (SI-NO) : ";
            $confirma = strtoupper((trim(fgets(STDIN))));
            if ($confirma == "SI") {
                if ($obj->modificar()) {
                    $obj->buscar($clave);
                    echo ("\n.Nuevos Valores de " . $obj . "\n");
                } else {
                    echo $obj->getMensajeoperacion();
                    echo ("\n.Fallo la actualizacion\n");
                }
            } else {
                echo ("\n.No se produjo ninguna modificacion\n");
            }
        } else {
            echo "Fallo la delegacion\n";
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo ("No se encuentra el Viaje " . $clave . "\n");
    }
}
function modificarPasajero()
{ //Devuelve un True si encontro la clave y modificó.
    echo ("Ingrese DNI del Pasajero (Solo numeros) : ");
    $clave = trim(fgets(STDIN));

    $obj = new Pasajero();
    if ($obj->buscar($clave)) {
        echo ("Ingrese Nombre: ");
        $aux1 = trim(fgets(STDIN));
        echo ("Ingrese Apellido: ");
        $aux2 = trim(fgets(STDIN));
        echo ("Ingrese Telefono (Solo Numeros): ");
        $aux3 = (int)(trim(fgets(STDIN)));

        $obj->setNombre($aux1);
        $obj->setApellido($aux2);
        $obj->setTelefono($aux3);
        if ($obj->modificar()) {
            $obj->buscar($clave);
            echo ("\n.Nuevos Valores de " . $obj . "\n");
        } else {
            echo $obj->getMensajeoperacion();
            echo ("\n.Fallo la actualizacion\n");
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el pasajero con DNI: " . $clave;
    }
}


/********************************************************************* */
function eliminarEmpresa()
{
    $obj = new Empresa();
    echo ("Ingrese Clave de Empresa: ");
    $clave = (int)(trim(fgets(STDIN)));
    if ($obj->buscar($clave)) {
        if ($obj->eliminar()) {
            echo ("Se elimino con exito \n\n");
        } else {
            if (strpos($obj->getMensajeoperacion(), "1451") > 0) {
                echo "\nERROR 1451: No se puede borrar la Empresa " . $clave . " por encontrarse asignada en un Viaje.\n";
            } else {
                echo $obj->getMensajeoperacion();
                echo ("\nFallo en la eliminacion\n");
            }
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra la empresa de clave " . $clave . "\n";
    }
}
function eliminarResponsables()
{
    $obj = new Responsable();
    echo ("Ingrese NumeroEmpleado de Responsable: ");
    $clave = trim(fgets(STDIN));

    if ($obj->buscar($clave)) {
        if ($obj->eliminar()) {
            echo ("Se elimino con exito \n\n");
        } else {
            if (strpos($obj->getMensajeoperacion(), "1451") > 0) {
                echo "\nERROR 1451: No se puede borrar el Responsable " . $clave . " por encontrarse asignado en un Viaje.\n";
            } else {
                echo $obj->getMensajeoperacion();
                echo ("\nFallo en la eliminacion\n");
            }
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Reponsable de clave " . $clave . "\n";
    }
}
function eliminarViaje()
{
    $obj = new Viaje();
    echo ("Ingrese Numero de Viaje: ");
    $clave = (int)(trim(fgets(STDIN)));

    if ($obj->buscar($clave)) {
        if ($obj->eliminar()) {
            echo ("Se elimino con exito \n\n");
        } else {
            if (strpos($obj->getMensajeoperacion(), "1451") > 0) {
                echo "\nERROR 1451: No se puede borrar la Viaje " . $clave . " por contener Pasajeros.\n";
            } else {
                echo $obj->getMensajeoperacion();
                echo ("\nFallo en la eliminacion\n");
            }
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo "No se encuentra el Viaje de clave " . $clave . "\n";
    }
}
function eliminarPasajero()
{
    echo ("Ingrese DNI del Pasajero (Solo numeros) : ");
    $clave = (int)(trim(fgets(STDIN)));

    $obj = new Pasajero();
    if ($obj->buscar($clave)) {
        if ($obj->eliminar()) {
            echo ("Se elimino con exito \n\n");
        } else {
            if (strpos($obj->getMensajeoperacion(), "1451") > 0) {
                echo "\nERROR 1451: No se puede borrar el Pasajero " . $clave . " por encontrarse en la lista de un Viaje.\n";
            } else {
                echo $obj->getMensajeoperacion();
                echo ("\nFallo en la eliminacion\n");
            }
        }
    } else {
        echo $obj->getMensajeoperacion();
        echo ("No se encuentra la clave " . $clave . "\n");
    }
}


function borrarDatosMySql()
{
    $base = new BaseDatos();
    echo "Ingrese Password: ";
    $clave = trim(fgets(STDIN));
    if ($clave == "123") {
        if ($base->Iniciar()) {
            if ($base->Ejecutar("DELETE FROM pasajero")) {
                echo "Se borró contenido de pasajero.\n";
            } else {
                $base->getError();
                echo "No se borró contenido de pasajero.\n";
            }

            if ($base->Ejecutar("DELETE FROM viaje")) {
                echo "Se borró contenido de viaje.\n";
            } else {
                $base->getError();
                echo "No se borró contenido de viaje.\n";
            }
            if ($base->Ejecutar("ALTER TABLE `bdviajes`.`viaje` AUTO_INCREMENT = 1")) {
                echo "Se reseteo el autoincrement...\n";
            } else {
                $base->getError();
                echo "Error en reset autoincrement Viaje.\n";
            }


            if ($base->Ejecutar("DELETE FROM empresa")) {
                echo "Se borro contenido de empresa.\n";
            } else {
                $base->getError();
                echo "No se borró contenido empresa.\n";
            }
            if ($base->Ejecutar("ALTER TABLE `bdviajes`.`empresa` AUTO_INCREMENT = 1 ")) {
                echo "Se reseteo el autoincrement...\n";
            } else {
                $base->getError();
                echo "Error en reset autoincrement Empresa.\n";
            }


            if ($base->Ejecutar("DELETE FROM responsable")) {
                echo "Se borró contenido responsable.\n";
            } else {
                $base->getError();
                echo "No se borró contenido responsable.\n";
            }
            if ($base->Ejecutar("ALTER TABLE `bdviajes`.`responsable` AUTO_INCREMENT = 1 ")) {
                echo "Se reseteo el autoincrement...\n";
            } else {
                $base->getError();
                echo "Error en reset autoincrement Responsable.\n";
            }
        } else {
            $base->getError();
            echo "No se pudo borrar ningún dato anterior.\n";
        }
    } else {
        echo "Le erraste a la clave....\n";
    }
}
