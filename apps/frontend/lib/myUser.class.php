<?php

class myUser extends sfBasicSecurityUser
{
    /**
     * Abre la sesión de la aplicación a un Estudiante
     *
     * @param Estudiante $estudiante
     * @param EntidadEducativa $entidadEducativa
     */
    function entrar(Estudiante $estudiante, EntidadEducativa $entidadEducativa){
        //credeniales de la persona
        $this->setAttribute('nombrePersona', $estudiante->getPersona()->getNombre());
        $this->setAttribute('idPersona', $estudiante->getIdEstudiante());
        $this->setAttribute('idCodigo', $estudiante->getCodCurso());
        $this->setAttribute('idCurso', $estudiante->getIdCurso());
        $this->cargaEntidadEducativa($entidadEducativa);
        $this->setAuthenticated(true);
    }
    /**
     * Abre la sesión de la aplicación a un Jurado
     *
     * @param Estudiante $estudiante
     * @param EntidadEducativa $entidadEducativa
     */
    function entrarJurado(Persona $persona, EntidadEducativa $entidadEducativa){
        //credeniales de la persona
        $this->setAttribute('nombrePersona', $persona->getNombre());
        $this->setAttribute('jornada', $persona->getJurado()->getMesaEntidadEducativa()->getIdTipoJornada());
        $this->setAttribute('mesa', $persona->getJurado()->getIdMesa());
        $this->setAttribute('cargo', $persona->getJurado()->getIdTipoJurado());
        $this->setAttribute('idPersona', $persona->getIdPersona());
        $this->setAttribute('presidente', $persona->getJurado()->getTipo()->getNombre() == 'Presidente');
        $this->cargaEntidadEducativa($entidadEducativa);
        $this->setAuthenticated(true);
    }
    /**
     * Carga el menú para un jurado de votación
     *
     * @param Jurado $jurado Jurado que inicia la sesión
     */
    function menuJurado(Jurado $jurado){
        $menu = array(
            array(
                'nombre' => 'Lista de Votantes',
                'accion' => '@listarVotante'
            ),
        );
//        foreach($votante as $votacion){
//            if($votacion->getHabilitado())
//                array_push($menu, array(
//                'nombre' => 'Lista de Candidatos',
//                'accion' => 'listarCandidatos?abreviatura='.$this->getAttribute('abreviaturaEntidadEducativa')
//            ));
//        }
        $elecciones = TipoTable::getTipoObjeto('elección');
        foreach ($elecciones as $eleccion) {
            array_push($menu, array(
                'nombre' => 'Votos General de Candidatos de "'.$eleccion->getNombre().'"',
                'accion' => '@listarCandidatos?eleccion='.$eleccion->getNombre()
            ));
            array_push($menu, array(
                'nombre' => 'Votos por Mesa de Candidatos de "'.$eleccion->getNombre().'"',
                'accion' => '@votosMesa?eleccion='.$eleccion->getNombre()
            ));
        }
        array_push($menu, array(
            'nombre' => 'Conteo Total de Votos',
            'accion' => '@votosCandidatos'
        ));
        if($jurado->getTipo()->getNombre() == 'Presidente' || $jurado->getTipo()->getNombre() == 'Jurado'){
            array_push($menu, array(
                'nombre' => 'Habilitar Votante',
                'accion' => '@habilitaVotante'
            ));
        }
        return $menu;
    }
    /**
     * Carga el menú para un votante
     *
     * @param Votante $votante Votante que inicia la sesión
     */
    function menuVotante($votante){
        $menu = array();
//        foreach($votante as $votacion){
//            if($votacion->getHabilitado())
//                array_push($menu, array(
//                    'nombre' => 'Votación de "'.$votacion->getTipo()->getNombre().'"',
//                    'accion' => 'votar?votacion='.$votacion->getTipo()->getNombre()
//                ));
//        }
            if($votante->getHabilitado() && !$votante->getVoto())
                array_push($menu, array(
                    'nombre' => 'Votación de "'.$votante->getTipo()->getNombre().'"',
                    'accion' => '@votar?votacion='.$votante->getTipo()->getNombre()
                ));
        if(empty($menu)){
            $menu['msg'] = 'Votante no habilitado o ya Voto';
        }
        return $menu;
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
    
    public function getPaginador($tableName, $query, $pagina = 1, $maxPerPage = 28){
      $paginador = new sfDoctrinePager($tableName, $maxPerPage);
      $paginador->setQuery($query);
      $paginador->setPage($pagina);
      $paginador->init();

      return $paginador;
    }
}
