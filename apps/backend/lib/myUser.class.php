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
    function entrar(Persona $persona, $entidadEducativa){
        //credeniales de la persona
        $this->setAttribute('nombrePersona', $persona->getNombre());
        $this->setAttribute('idPersona', $persona->getIdPersona());
        $this->cargaEntidadEducativa($entidadEducativa);
        $this->setAuthenticated(true);
        $array = array();
        $array['menu'] = $this->getMenu($persona->getPerfilesPersona());
        $array['entidadesEducativas'] = EntidadEducativaTable::getInstance()->findAll();
        
        return $array;
    }
    
    /**
     * Carga datos visuales de la entidad educativa
     *
     * @param EntidadEducativa $entidadEducativa
     */
    function cargaEntidadEducativa(EntidadEducativa $entidadEducativa){
        $this->setAttribute('abreviaturaEntidadEducativa', $entidadEducativa->getAbreviatura());
        $this->setAttribute('idEntidadEducativa', $entidadEducativa->getIdEntidadEducativa());
        $archivo = $entidadEducativa->getUrlImagen('Encabezado');
        if(!is_null($archivo))
            $this->setAttribute('fondoCabColegio', $archivo);
        $archivo = $entidadEducativa->getUrlImagen('Logo');
        if(!is_null($archivo))
            $this->setAttribute('logoColegio', $archivo);
        $archivo = $entidadEducativa->getUrlImagen('Mensaje');
        if(!is_null($archivo))
            $this->setAttribute('fondoMsgColegio', $archivo);
        $archivo = $entidadEducativa->getUrlImagen('Pie');
        if(!is_null($archivo))
            $this->setAttribute('fondoPieColegio', $archivo);
    }
    
    /**
     * Genera el menú de acuerdo a los tipos que puede tener una persona.
     *
     * @param TipoPersona $tiposPersona
     */
    function getMenu($tiposPersona){
        $menu = array(
            array(
              'nombre'  => 'Agregar Fondo de Encabezado',
              'accion'  => 'agregaFondo?fondo=Encabezado',
            ),
            array(
              'nombre'  => 'Agregar Fondo de Pie',
              'accion'  => 'agregaFondo?fondo=Pie',
            ),
            array(
              'nombre'  => 'Agregar Fondo de Mensaje',
              'accion'  => 'agregaFondo?fondo=Mensaje',
            ),
            array(
              'nombre'  => 'Agregar Logo',
              'accion'  => 'agregaLogo',
            ),
            array(
              'nombre'  => 'Agregar Mesas',
              'accion'  => 'agregaMesa',
            ),
            array(
              'nombre'  => 'Ver Mesas',
              'accion'  => 'listarMesas',
            ),
            array(
              'nombre'  => 'Agregar Grados',
              'accion'  => 'agregaGrado',
            ),
            array(
              'nombre'  => 'Ver Grados',
              'accion'  => 'listarGrados',
            ),
            array(
              'nombre'  => 'Agregar Estudiantes',
              'accion'  => 'agregaEstudiante',
            ),
            array(
              'nombre'  => 'Ver Estudiantes',
              'accion'  => 'listarEstudiantes',
            ),
            array(
              'nombre'  => 'Agregar Votante',
              'accion'  => 'agregaVotante',
            ),
            array(
              'nombre'  => 'Ver Votantes',
              'accion'  => 'listarVotantes',
            ),
            array(
              'nombre'  => 'Agregar Candidatos',
              'accion'  => 'agregaCandidato',
            ),
            array(
              'nombre'  => 'Ver Candidato',
              'accion'  => 'listarCandidatos',
            ),
            array(
              'nombre'  => 'Agregar Jurados',
              'accion'  => 'agregaJurado',
            ),
            array(
              'nombre'  => 'Ver Jurados',
              'accion'  => 'listarJurados',
            ),
            array(
              'nombre'  => 'Cargar Datos',
              'accion'  => 'cargaDatos?tipo=csv',
            ),
            array(
              'nombre'  => 'Salir',
              'accion'  => 'salir?abreviatura='.$this->getAttribute('abreviaturaEntidadEducativa'),
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
