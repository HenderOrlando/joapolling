<?php

/**
 * TipoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TipoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TipoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Tipo');
    }
    /**
     * Retorna los tipos de un objeto.
     *
     * @param $objeto String Nombre del objeto al que desea conocer los tipos
     * @return array Tipo
     */
    public static function getTipoObjeto($objeto)
    {
        return TipoTable::getInstance()->findBy('objeto', $objeto);
    }
    
    /**
     * Retorna los tipos de un objeto en
     * formato array[clave] = valor.
     * 
     * @param Array $opciones
     *      opciones[objeto]= (String)  Nombre del objeto al que desea conocer los tipos
     *      opciones[id]    = (Boolean) Alterna entre el nombre o el identificador
     *      opciones[empty] = (Boolean | String) Agregar Elemento Vacio
     * @return Array
     */
    public static function getArrayTipoObjeto($opciones)
    {
        $tipos_ = TipoTable::getTipoObjeto($opciones['objeto']);
        $tipos = array();
        if(isset($opciones['empty']))
            if(is_bool($opciones['empty'])){
                $tipo['-1'] = ' ';
            }else{
                $tipo['-1'] = $opciones['empty'];
            }
        foreach ($tipos_ as $tipo){
            if(isset($opciones['id']))
                $tipos[$tipo->getIdTipo()] = $tipo->getIdTipo();
            else
                $tipos[$tipo->getIdTipo()] = $tipo->getNombre();
        }
        return $tipos;
    }
    
    public function getPerfiles(){
        $perfiles = TipoTable::getTipoObjeto('persona');
        foreach($perfiles as $id => $tipos){
            if($tipos->getNombre() == 'Super Administrador')
                unset($perfiles[$id]);
        }
        return $perfiles;
    }
    
    public function getJornadas(){
        return TipoTable::getTipoObjeto('jornada');
    }
    
    public function getTiposElecciones(){
        return TipoTable::getTipoObjeto('elección');
    }
    
    public function getTiposJurado(){
        return TipoTable::getTipoObjeto('jurado');
    }
    
    public function getTiposDocumentoIdentidad(){
        return TipoTable::getTipoObjeto('documento_de_identidad');
    }
    
    public function getArrayPerfiles(){
        return TipoTable::getArrayTipoObjeto(array('objeto' => 'persona','empty' => 'Elija un Perfil'));
    }
}