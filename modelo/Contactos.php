<?php

/*
 * Archivo que tiene la clase que va a encapsular la informacion de una persona
 * que pueda guardar sus contactos y tambien los administradores
 * puedan tener acceso a todas las tablas y poder editarlas
 * 
 * 
 *  */
include_once ("AccesoDatos.php");
include_once("Persona.php");
class Contacto extends Persona{
    private $nTipo=0;
    private $nIdPersonal=0;
    private $nIdContacto=0;
    
    //constantes para ver que tipo de usuario es
    const TIPO_ADMIN=1;
    const TIPO_VISUALIZADOR=2;
    
    
    function setTipo($pnTipo){
        $this->nTipo=$pnTipo;
    }
    
    function getTipo(){
        return $this->nTipo;
    }
    
    function setIdPersonal($pnIdPersonal){
        $this->nIdPersonal=$pnIdPersonal;
    }
    
    function getIdPersonal(){
        return $this->nIdPersonal;
    }
    function setIdContacto($pnIdContacto){
        $this->nIdContacto=$pnIdContacto;
    }
    
    function getIdContacto(){
        return $this->nIdContacto;
    }
    
    /*Buscar por clave, rgersar true si se encontro */
    function buscarPorVisualizador ($idVisualizador){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=null;
        $bRet=false;
        $arrResultado=[];
        $j=0;
        if ($idVisualizador == 0) {
        throw new Exception("Contactos->buscarPorVisualizador(): faltan datos");
    } else {
        if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT id_contacto, nombreCompleto, direccion, telefono, email 
                       FROM contactos 
                       WHERE id_visualizador = " . $idVisualizador . "
                       ORDER BY nombreCompleto ASC";

            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
            $oAccesoDatos->desconectar();

            if ($arrRS && is_array($arrRS)) {
                foreach ($arrRS as $aLinea) {
                    $oPersHosp = new Contacto();
                    $oPersHosp->setIdPersonal($aLinea[0]);
                    $oPersHosp->setNombre($aLinea[1]);
                    $oPersHosp->setDireccion($aLinea[2]);
                    $oPersHosp->setTelefono($aLinea[3]);
                    $oPersHosp->setEmail($aLinea[4]);

                    $arrResultado[$j] = $oPersHosp;
                    $j++;
                }
            }
        }
    }

    return $arrResultado;
        
    }
    
    /*Insertar regresa el numero de registros agregados*/
    function insertar (){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
        if($this->sNombre=="" OR $this->sDireccion=="" OR $this->sTelefono=="" OR $this->sEmail==""){
            throw new Exception ("Contactos->insertar(): faltan datos");
            
        }
        if ($this->nIdPersonal <= 0) {
        throw new Exception("Contactos->insertar(): id_visualizador inválido");
    }
           if ($oAccesoDatos->conectar()) {
        $sQuery = "INSERT INTO contactos (nombreCompleto, direccion, telefono, email, id_visualizador)
                   VALUES ('" . $this->sNombre . "', 
                           '" . $this->sDireccion . "', 
                           '" . $this->sTelefono . "', 
                           '" . $this->sEmail . "', 
                           '" . $this->nIdPersonal . "');";

        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
        $oAccesoDatos->desconectar();
    }
        
        if ($nAfectados > 0) {
        return $nAfectados;
    } else {
        throw new Exception("Contactos->insertar(): error al insertar contacto");
    }
    }
    
    //Modificar, regresa el numero de registros modificados
    function modificar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->sNombre=="" OR $this->sDireccion=="" OR $this->sTelefono=="" OR  $this->sEmail=="")
			throw new Exception("Contactos->modificar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                                // $this->nIdPersonal= intval($this->nIdPersonal);
		 		$sQuery = "UPDATE contactos
                                                                 SET nombreCompleto = '".$this->sNombre."',                   
                                                                 direccion = '".$this->sDireccion."', 
                                                                 telefono = '".$this->sTelefono."', 
                                                                email = '".$this->sEmail."'
                                                                WHERE id_contacto = ".$this->nIdPersonal;

				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
        /*Borrar, regresa el número de registros eliminados*/
	function borrar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPersonal==0)
			throw new Exception("Contactos->borrar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                                $this->nIdPersonal=intval($this->nIdPersonal);
		 		$sQuery = "DELETE FROM contactos WHERE id_contacto = ".$this->nIdPersonal;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
        
        
        /*Busca todos los registros del personal hospitalario,
	 regresa falso si no hay información o un arreglo de PersonalHospitalario*/
	function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oPersHosp=null;
	$arrResultado=[];
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT  id_contacto,nombreCompleto, direccion, telefono, email, id_visualizador
                                                FROM contactos
                                               ORDER BY id_visualizador";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPersHosp = new Contacto();
                                                                                $oPersHosp->setIdContacto($aLinea[0]);
					$oPersHosp->setNombre($aLinea[1]);
					$oPersHosp->setDireccion($aLinea[2]);					
					$oPersHosp->setTelefono ($aLinea[3]);
					$oPersHosp->setEmail($aLinea[4]);
					$oPersHosp->setIdPersonal($aLinea[5]);
                                                                                $arrResultado[$j] = $oPersHosp;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}
        
        function Buscar(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=null;
        $bRet=false;
        
        if ($this->nIdPersonal==0)
            throw  new Swoole\Exception ("UsuariosContactos->buscar(): faltan datos");
        else{
            if($oAccesoDatos->conectar()){
                $sQuery="SELECT nombreCompleto, direccion,telefono,email FROM contactos WHERE id_contacto= ".$this->nIdPersonal;
                $arrRS=$oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if($arrRS){
                    $this->sNombre=$arrRS[0][0];
                     $this->sDireccion=$arrRS[0][1];
                      $this->sTelefono=$arrRS[0][2];
                       $this->sEmail=$arrRS[0][3];
                    
                   // $this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][1]);
                    //$this->sSexo=$arrRS[0][2];
                    //$this->nTipo=$arrRS[0][3];
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }
    
    function BuscarDos(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=null;
        $bRet=false;
        
        if ($this->nIdPersonal==0)
            throw  new Swoole\Exception ("UsuariosContactos->buscar(): faltan datos");
        else{
            if($oAccesoDatos->conectar()){
                $sQuery="SELECT nombreCompleto, direccion,telefono,email,id_visualizador FROM contactos WHERE id_contacto= ".$this->nIdPersonal;
                $arrRS=$oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if($arrRS){
                    $this->sNombre=$arrRS[0][0];
                     $this->sDireccion=$arrRS[0][1];
                      $this->sTelefono=$arrRS[0][2];
                       $this->sEmail=$arrRS[0][3];
                        $this->nIdPersonal=$arrRS[0][4];
                    
                   // $this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][1]);
                    //$this->sSexo=$arrRS[0][2];
                    //$this->nTipo=$arrRS[0][3];
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }
    function modificarDos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->sNombre=="" OR $this->sDireccion=="" OR $this->sTelefono=="" OR  $this->sEmail=="")
			throw new Exception("Contactos->modificar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                                // $this->nIdPersonal= intval($this->nIdPersonal);
		 		$sQuery = "UPDATE contactos
                                                                 SET nombreCompleto = '".$this->sNombre."',                   
                                                                 direccion = '".$this->sDireccion."', 
                                                                 telefono = '".$this->sTelefono."', 
                                                                email = '".$this->sEmail."',
                                                                id_visualizador=".$this->nIdPersonal." 
                                                                WHERE id_contacto = ".$this->nIdContacto;

				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
    
    
    
}
?>