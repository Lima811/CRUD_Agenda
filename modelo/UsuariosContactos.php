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
class UsuariosContactos extends Persona{
    private $nTipo=0;
    private $nIdPersonal=0;
    
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
    
    /*Buscar por clave, rgersar true si se encontro */
    function Buscar(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=null;
        $bRet=false;
        
        if ($this->nIdPersonal==0)
            throw  new Swoole\Exception ("UsuariosContactos->buscar(): faltan datos");
        else{
            if($oAccesoDatos->conectar()){
                $sQuery="SELECT sNombre, dFecNacim, sSexo, nTipo FROM usuarioscontactos WHERE nIdPersonal= ".$this->nIdPersonal;
                $arrRS=$oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if($arrRS){
                    $this->sNombre=$arrRS[0][0];
                    $this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][1]);
                    $this->sSexo=$arrRS[0][2];
                    $this->nTipo=$arrRS[0][3];
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }
    
    /*Insertar regresa el numero de registros agregados*/
    function insertar (){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
        if($this->sNombre=="" OR $this->dFechaNacim==null OR $this->sSexo=="" OR $this->nTipo==0){
            throw new Exception ("UsuariosContactos->insertar(): faltan datos");
            
        }else{
          if ($oAccesoDatos->conectar()){
		 		$sQuery = "INSERT INTO usuarioscontactos (sNombre,dFecNacim, sSexo, nTipo)
					VALUES ('".$this->sNombre."',					
					'".$this->dFechaNacim->format('Y-m-d')."',
					'".$this->sSexo."', ".$this->nTipo.");";
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                                //investigue para obtener el id del usuariocontacto de manera inmediata
                                                                    $this->nIdPersonal = $oAccesoDatos->lastInsertId();
				$oAccesoDatos->desconectar();
			}
        }
        return $nAfectados;
    }
    
    //Modificar, regresa el numero de registros modificados
    function modificar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPersonal==0 OR $this->sNombre == "" OR 
		    $this->sSexo == "" OR $this->nTipo == 0 OR $this->dFechaNacim==null)
			throw new Exception("PersonalHospitalario->modificar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "UPDATE usuarioscontactos
					SET sNombre= '".$this->sNombre."' ,					
					dFecNacim = '".$this->dFechaNacim->format('Y-m-d')."',
					sSexo = '".$this->sSexo."',
					nTipo = ".$this->nTipo."
					WHERE nIdPersonal = ".$this->nIdPersonal;

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
			throw new Exception("PersonalHospitalario->borrar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
		 		$sQuery = "DELETE FROM usuarioscontactos
							WHERE nIdPersonal = ".$this->nIdPersonal;
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
		 	$sQuery = "SELECT nIdPersonal,sNombre,
							  dFecNacim, sSexo, nTipo
				FROM usuarioscontactos
				ORDER BY nIdPersonal";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPersHosp = new UsuariosContactos();
					$oPersHosp->setIdPersonal($aLinea[0]);
					$oPersHosp->setNombre($aLinea[1]);					
					$oPersHosp->setFechaNacim(DateTime::createFromFormat('Y-m-d',$aLinea[2]));
					$oPersHosp->setSexo($aLinea[3]);
					$oPersHosp->setTipo($aLinea[4]);
            		$arrResultado[$j] = $oPersHosp;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}
    
    
    
    
}
?>