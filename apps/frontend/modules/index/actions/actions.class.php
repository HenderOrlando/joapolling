<?php

/**
 * index actions.
 *
 * @package    sf_sandbox
 * @subpackage index
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndexJurado(sfWebRequest $request)
  {
        $usr = $this->getUser();
        $this->jurado = true;
        $this->form = new iniciaSesionJuradoForm();
        $entidad = $request->getParameter('abreviatura','-1');
        $msg = 'Bienvenido Jurado';
        $id_persona = $id_jornada = $id_mesa = $id_cargo = -1;
        if($entidad != -1){
            $this->ee = $entidad;
            if($entidad = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $entidad)){
                $this->form->setWidget('entidad_educativa', new sfWidgetFormInputHidden());
                $this->form->setDefault('entidad_educativa', $entidad->getIdEntidadEducativa());
                $usr->cargaEntidadEducativa($entidad);
            }else{
                $usr->setFlash('msg1', 'Entidad Educativa no enontrada');
                $this->redirect('@homepage');
            }
        }else{
            $usr->salir();
        }
        if($usr->isAuthenticated()){
            $msg       .= ' '.$usr->getAttribute('nombrePersona');
            $id_persona = $usr->getAttribute('idPersona');
            $id_entidad = $usr->getAttribute('idEntidadEducativa');
            $id_jornada = $usr->getAttribute('jornada');
            $id_mesa    = $usr->getAttribute('mesa');
            $id_cargo   = $usr->getAttribute('cargo');
        }
        elseif($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()) && $usr->procesarFormulario($this->form, $request, FALSE)){
            $id_persona = $this->form->getValue('doc_id');
            $id_entidad = $this->form->getValue('entidad_educativa');
            $id_jornada = $this->form->getValue('jornada');
            $id_mesa = $this->form->getValue('mesa');
            $id_cargo = $this->form->getValue('cargo');
        }
        if($persona = PersonaTable::getInstance()->find($id_persona)){
            if($entidad = $persona->isEntidadEducativa($id_entidad, true)){
                $menu = array();
                $salir = array(
                    'nombre'  => 'Salir',
                    'accion'  => '@salir',
                );
                $usr->entrarJurado($persona,$entidad);
                $e = $persona->getJurado();
                if($e && $e->getMesaEntidadEducativa()->getIdTipoJornada() == $id_jornada && $e->getIdMesa() == $id_mesa && $e->getIdTipoJurado() == $id_cargo){
                    $menu = array_merge($menu,$usr->menuJurado($e));
                }else{
                    $usr->salir();
                    $usr->setFlash('msg1', 'Usuario no es jurado');
                    $this->redirect('@homepageEntidadEducativa?abreviatura='.$entidad->getAbreviatura());
                }
                array_push($menu, $salir);
                $this->menu = $menu;
            }else{
                $msg = 'Usuario no válido';
            }
        }
        $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
        $this->setTemplate('index');
  }
 /**
  * Executes index Jurado action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
        $usr = $this->getUser();
        $this->form = new iniciaSesionColegioForm();
        $id_codigo = -1;
        $id_curso_grado = -1;
        $entidad = $request->getParameter('abreviatura','-1');
        $msg = 'Bienvenido Votante';
        if($entidad != -1){
            $this->ee = $entidad;
            if($entidad = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $entidad)){
                $this->form->setWidget('entidad_educativa', new sfWidgetFormInputHidden());
                $this->form->setDefault('entidad_educativa', $entidad->getIdEntidadEducativa());
                $usr->cargaEntidadEducativa($entidad);
            }else{
                $usr->setFlash('msg1', 'Entidad Educativa no enontrada');
                $this->redirect('@homepage');
            }
        }else{
            $usr->salir();
        }
        if($usr->isAuthenticated()){
            $msg .= ' '.$usr->getAttribute('nombrePersona');
            $id_codigo = $usr->getAttribute('idCodigo');
            $id_curso_grado = $usr->getAttribute('idCurso');
            $id_entidad = $usr->getAttribute('idEntidadEducativa');
        }
        elseif($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()) && $usr->procesarFormulario($this->form, $request, FALSE)){
            $id_codigo  = $this->form->getValue('codigo');
            $id_curso_grado   = $this->form->getValue('curso');
            $id_entidad = $this->form->getValue('entidad_educativa');
        }
        if($estudiante = EstudianteTable::getEstudianteCurso($id_curso_grado, $id_codigo)){
            if($entidad = $estudiante->getPersona()->isEntidadEducativa($id_entidad, true)){
                $menu = array();
                $salir = array(
                    'nombre'  => 'Salir',
                    'accion'  => '@salir',
                );
                $usr->entrar($estudiante,$entidad);
                $e = $estudiante->getVotante();
                if($e){
                    $menu = array_merge($menu,$usr->menuVotante($e));
                    if(isset($menu['msg'])){
                        $usr->salir();
                        $usr->setFlash('msg1', $menu['msg']);
                        $this->redirect('@homepageEntidadEducativa?abreviatura='.$entidad->getAbreviatura());
                    }elseif(count($menu) == 1){
                        $this->redirect($menu[0]['accion']);
                    }
                }else{
                    $msg = 'Usuario no puede votar';
                }
                array_push($menu, $salir);
                $this->menu = $menu;
            }else{
                $msg = 'Usuario no válido';
            }
        }
        $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  
  /**
   * Votar por un candidato
   * 
   * @param sfRequest $request A request object
   */
  public function executeVotar(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Elige un ';
      if($tipo = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('votacion'))){
          if($tipo->getObjeto() == 'elección'){
              $msg.=' "'.$request->getParameter('votacion').'"';
              if($votante = VotanteTable::getInstance()->createQuery()
                      ->andWhere('id_votante =? ', $usr->getAttribute('idPersona'))
                      ->andWhere('id_tipo_eleccion =? ', $tipo->getIdTipo())
                      ->fetchOne()){
                  $this->logMessage($votante->getIngresoVotar(),'err');
                  if(!$votante->getIngresoVotar() && $votante->getIdTipoEleccion() == $tipo->getIdTipo()){
                      $votante->setIngresoVotar(TRUE);
                      $votante->setFechaVoto(date('Y-m-d H:i:s'));
                      $votante->save();
                      $this->eleccion = $tipo->getNombre();
                      $usr->setFlash('tipoEleccion', $tipo->getNombre());
                      $candidatos = CandidatoTable::getCandidatosEleccion($tipo);
                      $this->candidatos = $candidatos;
                      $this->representa = array();
                      foreach ($candidatos as $candidato){
                          $c = false;
                          if($candidato->getIdCandidatoRepresenta() && $candidato->getIdCandidatoRepresenta() != $candidato->getIdCandidato()){
                            $c = CandidatoTable::getInstance()->findOneBy('id_candidato', $candidato->getIdCandidatoRepresenta());
                            if($c){
                                $this->representa[$candidato->getIdCandidato()] = $c->getArchivo()->getSrc();
                            } 
                          }
                      }
                  }else{
                      $usr->setFlash('msg1', 'Tu voto ya fué guardado.');
                      $this->redirect('@sal?abreviatura='.$usr->getAttribute('abreviaturaEntidadEducativa'));
                  }
              }
          }
      }
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  /**
   * Guarda el Voto a un candidato
   * 
   * @param sfRequest $request A request object
   */
  public function executeGuardarVoto(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Voto Guardado';
      $redirect = '@votar?votacion='.$request->getParameter('eleccion');
      if($request->isMethod(sfRequest::POST) && $request->hasParameter('eleccion')){
          if($tipo = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('eleccion'))){
              if($votante = VotanteTable::getInstance()->createQuery()->andWhere('id_votante =? ', $usr->getAttribute('idPersona'))->andWhere('id_tipo_eleccion =?', $tipo->getIdTipo())->fetchOne()){
                  if($request->hasParameter($tipo->getNombre())){
                    if($candidato = CandidatoTable::getInstance()->createQuery()->andWhere('no =?',$request->getParameter($tipo->getNombre()))->andWhere('id_tipo_eleccion =? ',$tipo->getIdTipo())->fetchOne()){
                        $votante->setVoto(TRUE);
                        $candidato->setVotos($candidato->getVotos()+1);
                        $votante->save();
                        $candidato->save();
                        $msg = 'Voto guardado con éxito';
                        $usr->setFlash('msg1', $msg);
                        $redirect = '@sal?abreviatura='.$usr->getAttribute('abreviaturaEntidadEducativa');
                    }else{
                        $msg = 'Candidato a '.$request->getParameter($tipo->getNombre()).' no válido';
                    }
                }else{
                    $msg = 'Error buscando el candidato';
                }
              }else{
                  $msg = 'Votante no válido';
              }
          }else{
              $msg = 'No encuentra el tipo de elecciones';
          }
      }else{
          $msg = 'Error obteniendo datos';
      }
      $usr->setFlash('msg1', $msg);
      $this->redirect($redirect);
  }
  /**
   * Listar los votante y su estado
   * 
   * @param sfRequest $request A request object
   */
  public function executeListaVotantes(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Lista de Votantes';
      $pag = 1;
      if($request->getParameter('pagina') > 0){
          $pag = $request->getParameter('pagina');
      }
      $q = VotanteTable::getInstance()->createQuery()->orderBy('habilitado DESC, voto DESC, id_mesa ASC');
      $this->paginador = $usr->getPaginador('Votante', $q, $pag);
      $msg .= ' Página '.$pag;
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  /**
   * Listar los candidatos y sus votaciones
   * 
   * @param sfRequest $request A request object
   */
  public function executeResultados(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    $usr = $this->getUser();
    $resultado = array();
    $resultado['plot'] = array();
    $resultado['xaxis'] = array();
    $tipo = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('eleccion'));
    $candidatos = CandidatoTable::getInstance()->findBy('id_tipo_eleccion',$tipo->getIdTipo());
    foreach($candidatos as $candidato){
//        if($candidato->getPersona()->isEntidadEducativa($usr->getAttribute('idEntidadEducativa'))){
            $label = 'Candidato No '.$candidato->getNo().' <br/> '.str_replace('-',' ',$candidato->getNombre());
            if($candidato->getNo() == 1 || $candidato->getNo() == 2)
                $label = 'Voto en Blanco ('.str_replace ('-Blanco', '', $candidato->getNombre()).')';
            array_push($resultado['plot'], array(
                'label' => $label.'<br/>('.$candidato->getVotos().')',
                'data'  => array(array($candidato->getNo(),$candidato->getVotos()))
            ));
            array_push($resultado['xaxis'], array(
                $candidato->getNo()  => $candidato->getNombre(),
            ));
//        }
    }
    //Abstención
    $NoAbstencion = VotanteTable::getInstance()->createQuery()->andWhere('id_tipo_eleccion =?',$tipo->getIdTipo())->andWhere('voto =?',0)->andWhere('ingreso_votar =?',1)->count();
    array_push($resultado['xaxis'], array(
        count($candidatos)  => 'Abstención',
    ));
    array_push($resultado['plot'], array(
        'label' => 'Abstención <br/>('.$NoAbstencion.')',
        'data'  => array(array(count($candidatos),$NoAbstencion))
    ));
    //No han votado
    $NoVotaron = VotanteTable::getInstance()->createQuery()->andWhere('id_tipo_eleccion =?',$tipo->getIdTipo())->andWhere('voto =?',0)->andWhere('ingreso_votar =?',0)->count();
    array_push($resultado['xaxis'], array(
        count($candidatos)  => 'No han votado',
    ));
    array_push($resultado['plot'], array(
        'label' => 'No han votado <br/>('.$NoVotaron.')',
        'data'  => array(array(count($candidatos),$NoVotaron))
    ));
    return $this->renderText(json_encode($resultado));
  }
  /**
   * Listar los candidatos y sus votaciones
   * 
   * @param sfRequest $request A request object
   */
  public function executeResultadosTotal(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    $usr = $this->getUser();
    $resultado = array();
    $resultado['plot'] = array();
    $resultado['xaxis'] = array();
    $candidatos = array();
    $sum_votos = array();
    foreach(CandidatoTable::getInstance()->createQuery('c')->orderBy('c.no ASC') as $candidato){
        $representa = $candidato->getIdCandidatoRepresenta()?$candidato->getIdCandidatoRepresenta():$candidato->getIdCandidato();
        if(!isset($candidatos[$representa]['label'])){
            if($candidato->getIdCandidatoRepresenta()){
                $c = CandidatoTable::getInstance()->find($representa);
            }
            if($representa == 1 || $representa == 2 ){
                $label = $candidatos[0]['label'] = 'Voto en Blanco'.' <br/> ('.$candidatos[0]['data'].')';
            }
            else{
                $label = $candidatos[$representa]['label'] = 'Candidato No '.$c->getNo().' <br/> '.str_replace('-',' ',$c->getNombre());
            }
        }
        if(isset($candidatos[$representa]['data'])){
            $candidatos[$representa]['data'] += $candidato->getVotos();
            $sum_votos[$representa] = $candidatos[$representa]['data'];
        }
        else{
            $candidatos[$representa]['data'] = $candidato->getVotos();
            $sum_votos[$representa] = $candidatos[$representa]['data'];
        }
    }
    foreach($sum_votos as $representa => $numVotos)
        $candidatos[$representa]['label'] = $candidatos[$representa]['label'].' <br/> ('.$numVotos.')';
    foreach ($candidatos as $id => $candidato){
//        if($candidato->getPersona()->isEntidadEducativa($usr->getAttribute('idEntidadEducativa'))){
            array_push($resultado['plot'], array(
                'label' => $candidato['label'],
                'data'  => array(array($id,$candidato['data']))
            ));
            array_push($resultado['xaxis'], array(
                $id  => $candidato['label'],
            ));
//        }
    }
    //Abstención
    $NoAbstencion = VotanteTable::getInstance()->createQuery()->andWhere('voto =?',0)->andWhere('ingreso_votar =?',1)->count();
    array_push($resultado['xaxis'], array(
        count($candidatos)  => 'Abstención',
    ));
    array_push($resultado['plot'], array(
        'label' => 'Abstención <br/> ('.$NoAbstencion.')',
        'data'  => array(array(count($candidatos),$NoAbstencion))
    ));
    //No han votado
    $NoVotaron = VotanteTable::getInstance()->createQuery()->andWhere('voto =?',0)->andWhere('ingreso_votar =?',0)->count();
    array_push($resultado['xaxis'], array(
        count($candidatos)  => 'No han votado',
    ));
    array_push($resultado['plot'], array(
        'label' => 'No han votado <br/> ('.$NoVotaron.')',
        'data'  => array(array(count($candidatos),$NoVotaron))
    ));
    return $this->renderText(json_encode($resultado));
  }
  /**
   * Listar los candidatos y sus votaciones por mesa
   * 
   * @param sfRequest $request A request object
   */
  public function executeResultadosMesa(sfWebRequest $request)
  {
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    $usr = $this->getUser();
    $resultado['plot'] = array();
    $resultado['xaxis'] = array();
    $tipo = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('eleccion'));
    $mesas = MesaTable::getInstance()->findAll();
    foreach($mesas as $mesa){
        $NoVotosMesa = VotanteTable::getInstance()->createQuery()
                    ->andWhere('id_tipo_eleccion =?',$tipo->getIdTipo())
                    ->andWhere('id_mesa =?',$mesa->getIdMesa())
                    ->andWhere('ingreso_votar =?',1)
                    ->count();
            array_push($resultado['plot'], array(
                'label' => 'Votos en "'.$mesa->getNombre().'"'.'<br/>('.$NoVotosMesa.')',
                'data'  => array(array($mesa->getIdMesa(), $NoVotosMesa))
            ));
            array_push($resultado['xaxis'], array(
                $mesa->getIdMesa() => $mesa->getNombre(),
            ));
//        }
    }
    //No han votado
    $NoVotaron = VotanteTable::getInstance()->createQuery()->andWhere('id_tipo_eleccion =?',$tipo->getIdTipo())->andWhere('ingreso_votar =?',0)->count(array('id_votante'));
    array_push($resultado['xaxis'], array(
        count($mesas)  => 'No han votado',
    ));
    array_push($resultado['plot'], array(
        'label' => 'No han votado<br/>('.$NoVotaron.')',
        'data'  => array(array(count($mesas),$NoVotaron))
    ));
    return $this->renderText(json_encode($resultado));
  }
  /**
   * Listar los candidatos y sus votaciones
   * 
   * @param sfRequest $request A request object
   */
  public function executeListaCandidatos(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Lista de Candidatos';
      if($tipoEleccion = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('eleccion'))){
//          $this->candidatos = CandidatoTable::getCandidatosEleccion($tipoEleccion);
          $this->totalVotantes = VotanteTable::getInstance()->createQuery()->andWhere('id_tipo_eleccion =?',$tipoEleccion->getIdTipo())->count()-1;
          $this->eleccion = $request->getParameter('eleccion');
      }
      $this->urlAjax = '@resultados';
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  /**
   * Habilitar un votante
   * 
   * @param sfRequest $request A request object
   */
  public function executeHabilitarVotante(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Habilitar Votantes';
      $this->form = new iniciaSesionColegioForm();
      $this->form->setWidget('entidad_educativa', new sfWidgetFormInputHidden());
      $this->form->setDefault('entidad_educativa', $usr->getAttribute('idEntidadEducativa'));
      if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()) && $usr->procesarFormulario($this->form, $request, FALSE)){
          $id_codigo  = $this->form->getValue('codigo');
          $id_curso   = $this->form->getValue('curso');
          if($estudiante = EstudianteTable::getEstudianteCurso($id_curso, $id_codigo)){
              if($estudiante->getPersona()->isEntidadEducativa($usr->getAttribute('idEntidadEducativa'))){
                  $votante = $estudiante->getVotante();
                  if(!$votante->getIngresoVotar()){
                    if(!$votante->getHabilitado()){
//                        if($votante->getIdMesa() == $usr->getAttribute('mesa') && $votante->getJornada() == $usr->getAttribute('jornada')){
                            $votante->setHabilitado(TRUE);
                            $votante->setIdMesa($usr->getAttribute('mesa'));
                            $votante->save();
                            $msg = 'Votante '.$estudiante->getNombre().' Habilitado';
//                        }else{
//                            $msg = 'El votante es de la "'.$votante->getMesa()->getNombre().'"';
//                        }
                    }else{
                        $msg = 'El Votante ya fué habilitado en la mesa "'.$votante->getMesa()->getMesa()->getNombre().'"';
                    }
                  }else{
                      $msg = 'El Votante ya votó en la mesa "'.$votante->getMesa()->getMesa()->getNombre().'"';
                  }
              }else{
                  $msg = 'Error, votante no válido';
              }
          }else{
              $msg = 'Estudiante no existe';
          }
      }
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  /**
   * Muestra los votos de los candidatos por mesa.
   * 
   * @param sfRequest $request A request object
   */
  public function executeVotosMesa(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Lista de Votos por Mesa';
      if($tipoEleccion = TipoTable::getInstance()->findOneBy('nombre', $request->getParameter('eleccion'))){
          $this->totalVotantes = VotanteTable::getInstance()->createQuery()->andWhere('id_tipo_eleccion =?',$tipoEleccion->getIdTipo())->count()-1;
          $this->eleccion = $request->getParameter('eleccion');
      }
      $this->urlAjax = '@resultadosMesa';
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
      
      $this->setTemplate('listaCandidatos');
  }
  /**
   * Muestra los votos de los candidatos sumando
   * los propios y los que representa.
   * 
   * @param sfRequest $request A request object
   */
  public function executeVotosTotales(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = 'Lista de Candidatos';
        $this->totalVotantes = VotanteTable::getInstance()->count()-2;
        $this->eleccion = 'total';
      $this->urlAjax = '@resultadosTotales';
      $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
      
      $this->setTemplate('listaCandidatos');
  }
  
//  private function getVotantes(Jurado $jurado, $votante = true){
//      $usr = $this->getUser();
//      if(is_bool($votante)){
//          return VotanteTable::getInstance()->createQuery()
//                  ->andWhere('id_tipo =?',$jurado->getTipoEleccion())
//                  ->execute();
//      }else{
//          return $jurado->getTipoEleccion() == $votante->getIdTipo() && 
//                  $votante->getPersona()->isEntidadEducativa($usr->getAttribute('idEntidadEducativa')) &&
//                  $votante->getIdMesa() == $usr->getAttribute('mesa') && 
//                  $votante->getJornada() == $usr->getAttribute('jornada');
//      }
//  }
 
  /**
  * Sale de la aplicación
  *
  * @param sfRequest $request A request object
  */
  public function executeSalir(sfWebRequest $request){
      $usr = $this->getUser();
      $msg = $usr->getFlash('msg1', 'Sesión finalizada');
      $usr->salir();
      $usr->setFlash('msg1', $msg);
      $this->redirect('index/index?abreviatura='.$request->getParameter('abreviatura'));
  }
}
