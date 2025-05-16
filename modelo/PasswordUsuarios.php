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
include_once ("Usuario.php");
class Password extends Persona{
    private $nTipo=0;
    private $nIdPersonal=0;
    private $nIdPassword=0;
    private $sPassword="";
    
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
    function setIdPassword($pnIdContacto){
        $this->nIdPassword=$pnIdContacto;
    }
    
    function getIdPassword(){
        return $this->nIdPassword;
    }
    
    function setPassword($psPassword){
        $this->sPassword=$psPassword;
    }
    
    function getPassword(){
        return $this->sPassword;
    }
    
    function borrar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPersonal==0)
			throw new Exception("Password->borrar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                                $this->nIdPersonal=intval($this->nIdPersonal);
		 		$sQuery = "DELETE FROM usuario WHERE nCveUsu = ".$this->nIdPassword;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
        
         function modificar(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->sPassword=="")
			throw new Exception("Modificar->modificar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                                // $this->nIdPersonal= intval($this->nIdPersonal);
		 		$sQuery = "UPDATE usuario
                                                                 SET sPassword = '".$this->sPassword."'                                                              
                                                                 WHERE nCveUsu = ".$this->nIdPassword;

				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
        
        /*function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oPersHosp=null;
	$arrResultado=[];
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT  nCveUsu,sPassword,nIdPersonal
                                                FROM usuario
                                               ORDER BY nCveUsu";
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPersHosp = new Password();
                                                                                  $oPersHosp->setIdPassword($aLinea[0]);	
                                                                                $oPersHosp->setPassword($aLinea[1]);	
                                                                                $oPersHosp->setIdPersonal($aLinea[2]);
                                                                                $arrResultado[$j] = $oPersHosp;
					$j=$j+1;
                }
			}
			else
				$arrResultado = false;
        }
		return $arrResultado;
	}*/
        
        function buscarTodos(){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$arrRS=null;
	$aLinea=null;
	$j=0;
	$oPersHosp=null;
	$arrResultado=[];
		if ($oAccesoDatos->conectar()){
		 	$sQuery = "SELECT us.nCveUsu, us.sPassword, us.nIdPersonal, uc.sNombre, uc.nTipo
                                                                FROM usuario us
                                                                INNER JOIN usuarioscontactos uc ON us.nIdPersonal = uc.nIdPersonal";
                                                                  
			$arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
			$oAccesoDatos->desconectar();
			if ($arrRS){
				foreach($arrRS as $aLinea){
					$oPersHosp = new Password();
                                                                                  $oPersHosp->setIdPassword($aLinea[0]);	
                                                                                $oPersHosp->setPassword($aLinea[1]);	
                                                                                $oPersHosp->setIdPersonal($aLinea[2]);
                                                                                $oPersHosp->setNombre($aLinea[3]);
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
        
        
        function Buscar(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $arrRS=[];
        $bRet=false;
        
        if ($this->nIdPassword==0)
            throw  new Swoole\Exception ("Password usuarios->buscar(): faltan datos");
        else{
            if($oAccesoDatos->conectar()){
                $sQuery="SELECT nCveUsu,sPassword,nIdPersonal FROM usuario us WHERE nCveUsu= ".$this->nIdPassword;
                $arrRS=$oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if($arrRS){
                    $this->nIdPassword=$arrRS[0][0];
                     $this->sPassword=$arrRS[0][1];
                      $this->nIdPersonal=$arrRS[0][2];
                       
                    
                   // $this->dFechaNacim = DateTime::createFromFormat('Y-m-d',$arrRS[0][1]);
                    //$this->sSexo=$arrRS[0][2];
                    //$this->nTipo=$arrRS[0][3];
                    $bRet=true;
                }
            }
        }
        return $bRet;
    }
        
        
    
}
?>

