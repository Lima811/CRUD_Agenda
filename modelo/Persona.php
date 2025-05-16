<?php
/*
Archivo:  Persona.php
Objetivo: clase que encapsula la información de una persona
Autor:    
*/
class Persona{
	protected $sNombre="";
	//protected $sApePat="";
                //protected $sApeMat="";
	protected $dFechaNacim=null;
	protected $sSexo="";
                protected $sDireccion="";
                protected $sTelefono="";
                protected $sEmail="";
                
                
    function setNombre($psNombre){
       $this->sNombre = $psNombre;
    }
    function getNombre(){
       return $this->sNombre;
    }
   
   /* function setApePat($psApePat){
       $this->sApePat = $psApePat;
    }   
    function getApePat(){
       return $this->sApePat;
    }
   
    function setApeMat($psApeMat){
       $this->sApeMat = $psApeMat;
    }
    function getApeMat(){
       return $this->sApeMat;
    }*/
   
    function setFechaNacim($pdFechaNacim){
       $this->dFechaNacim = $pdFechaNacim;
    }
    function getFechaNacim(){
       return $this->dFechaNacim;
    }
   
    function setSexo($psSexo){
       $this->sSexo = $psSexo;
    }
    function getSexo(){
       return $this->sSexo;
    }
    
    function setEmail($psEmail){
        $this->sEmail=$psEmail;
    }
    function getEmail(){
        return $this->sEmail;
    }
    
    function setDireccion($psDireccion){
        $this->sDireccion=$psDireccion;
    }
    function getDireccion(){
        return $this->sDireccion;
    }
    function setTelefono($psTelefono){
        $this->sTelefono=$psTelefono;
    }
    function getTelefono(){
        return $this->sTelefono;
    }
	
	function getNombreCompleto(){
		return $this->sNombre;
	}
}
?>