<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
Autor:
*/
include_once("AccesoDatos.php");
include_once("UsuariosContactos.php");
class Usuario{ // clase base  "padre"
	private $nClave = 0;
	private $sPwd = "";
	private $oPersonalHosp = null;
	private $oAD = null;

	public function getPersHosp(){
		return $this->oPersonalHosp;
	}
	public function setPersHosp($valor){
		$this->oPersonalHosp = $valor;
	}

	public function getClave(){
		return $this->nClave;
	}
	public function setClave($valor){
		$this->nClave = $valor;
	}

	public function getPwd(){
		return $this->sPwd;
	}
	public function setPwd($valor){
		$this->sPwd = $valor;
	}

	public function buscarCvePwd(){
	$bRet = false;
	$sQuery = "";
	$arrRS = null;
		if (($this->nClave == 0 || $this->sPwd == "") )
			throw new Exception("Usuario->buscar: faltan datos");
		else{
			$sQuery = "SELECT t1.nIdPersonal
					   FROM usuario t1
					   WHERE t1.nCveUsu = ".$this->nClave."
					   AND t1.sPassword = '".$this->sPwd."'";
			//Crear, conectar, ejecutar, desconectar
			$oAD = new AccesoDatos();
			if ($oAD->conectar()){
				$arrRS = $oAD->ejecutarConsulta($sQuery);
				$oAD->desconectar();
				if ($arrRS != null){
					$this->oPersonalHosp = new UsuariosContactos();
					$this->oPersonalHosp->setIdPersonal($arrRS[0][0]);
					$this->oPersonalHosp->buscar();
					$bRet = true;
				}
			}
		}
		return $bRet;
	}
        
      public function insertarUsuario($nIdPersonal, $sNombre) {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;

    if ($nIdPersonal == 0 || $sNombre == "") {
        throw new Exception("Usuario->insertarUsuario(): faltan datos");
    } else {
        if ($oAccesoDatos->conectar()) {
            $sQuery = "INSERT INTO usuario (sPassword, nIdPersonal) 
                       VALUES ('" . $sNombre . "!', " . $nIdPersonal . ");";
            $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
            $oAccesoDatos->desconectar();
        }
    }
    return $nAfectados;
}
function borrar($cve_usu){
	$oAccesoDatos=new AccesoDatos();
	$sQuery="";
	$nAfectados=-1;
		if ($this->nIdPersonal==0)
			throw new Exception("Password->borrar(): faltan datos");
		else{
			if ($oAccesoDatos->conectar()){
                                                               // $this->nIdPersonal=intval($this->nIdPersonal);
		 		$sQuery = "DELETE FROM usuario WHERE nCveUsu = ".$cve_usu;
				$nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
				$oAccesoDatos->desconectar();
			}
		}
		return $nAfectados;
	}
}
?>
