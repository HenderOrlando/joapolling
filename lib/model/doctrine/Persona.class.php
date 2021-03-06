<?php

/**
 * Persona
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Persona extends BasePersona
{
    public function hasTipo($id_tipo, $obj = false){
        foreach($this->getPerfilesPersona() as $tipoPersona){
            if($tipoPersona->getIdTipoPerfil() == $id_tipo)
                if($obj)
                    return $tipoPersona;
                else
                    return true;
        }
        return false;
    }
    
    public function isEntidadEducativa($id_entidad, $obj = false){
        foreach ($this->getPerfilesPersona() as $tp){
            if($tp->getIdEntidadEducativa() == $id_entidad){
                if($obj)
                    return $tp->getEntidadEducativa();
                return true;
            }
        }
        return false;
    }
    
//    /*
//     * Retorna los perfiles que la persona posee
//     * 
//     * return Array TipoPersona
//     */
//    public function getPerfilesTiposPersona(){
//        return PerfilesPersonaTable::getInstance()->findBy('id_persona', $this->getIdPersona());
//    }
        
    /*
     * Retorna el votante
     * 
     * return Votante $votante
     */
    public function getVotante(){
        $votante = VotanteTable::getInstance()->findOneBy('id_votante',$this->getIdPersona());
        return $votante;
    }
    
    /*
     * Retorna el jurado
     * 
     * return Jurado $jurado
     */
    public function getJurado(){
        $jurado = JuradoTable::getInstance()->find($this->getIdPersona());
        if(is_a($jurado, 'Jurado'))
            return $jurado;
        return false;
    }
    
    /*
     * Retorna el estudiante
     * 
     * return Estudiante $estudiante
     */
    public function getEstudiante(){
        $estudiante = EstudianteTable::getInstance()->find($this->getIdPersona());
        if(is_a($estudiante, 'Estudiante'))
            return $estudiante;
        return false;
    }
    
    /*
     * Retorna la Jornada
     * 
     * return Tipo $jornada
     */
    public function getJornada(){
        return $this->getVotante()->getMesa()->getJornada();
    }
    
    public function getNombres() {
        $nombre = explode('-', $this->getNombre());
        return $nombre[0];
    }
    
    public function getApellidos() {
        $apellido = explode('-', $this->getNombre());
        return $apellido[1];
    }
    
    public function getNombreApellido() {
        $nombreApellido = explode('-', $this->getNombre());
        return $nombreApellido[0].' '.$nombreApellido[1];
    }
}
