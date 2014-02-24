<?php

class myUser extends sfBasicSecurityUser
{
    /**
     * Cierra la sesión de la aplicación
     *
     */
    function salir(){
        $this->setAuthenticated(false);
        $this->clearCredentials();
        $this->getAttributeHolder()->clear();
    }

    /**
     * Abre la sesión de la aplicación
     *
     * @param Persona $persona
     */
    function entrar(Persona $persona){
        //credeniales de la persona
        $this->setAttribute('nombrePersona', $persona->getNombre());
        $this->setAttribute('idPersona', $persona->getIdPersona());
        $this->setAuthenticated(true);
        $array = array();
        $array['menu'] = $this->getMenu($persona->getPerfilesPersona());
        $array['entidadesEducativas'] = EntidadEducativaTable::getEntidadesEducativas1();
        
        return $array;
    }
    
    /**
     * Genera el menú de acuerdo a los tipos que puede tener una persona.
     *
     * @param TipoPersona $tiposPersona
     */
    function getMenu($tiposPersona){
        $menu = array(
            array(
              'nombre'  => 'Agregar Entidad Educativa',
              'accion'  => 'agregaEntidad',
            ),
            array(
              'nombre'  => 'Salir',
              'accion'  => 'salir',
            ),
        );
        return $menu;
    }

    /**
     * Abre la sesión de la aplicación
     *
     * @param Form      $form
     * @param Request   $request
     * @param bool   $guardar
     */
    function procesarFormulario($form, $request, $guardar = true){
        if(method_exists($request, 'getParameter'))
            $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        else
            $form->bind($request);
        if ($form->isValid())
        {
            if(method_exists($form, 'getObject')){
                if($guardar){
                    $obj = $form->save();
                    return $obj;
                }
                return $form->getObject();
            }
            return true;
        }
        return false;
    }
    
    public function getPaginador($tableName, $query, $pagina = 1, $maxPerPage = 14){
      $paginador = new sfDoctrinePager($tableName, $maxPerPage);
      $paginador->setQuery($query);
      $paginador->setPage($pagina);
      $paginador->init();

      return $paginador;
    }
}
