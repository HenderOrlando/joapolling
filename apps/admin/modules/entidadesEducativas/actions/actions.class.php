<?php

/**
 * entidadesEducativas actions.
 *
 * @package    sf_sandbox
 * @subpackage entidadesEducativas
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class entidadesEducativasActions extends sfActions
{
  /**
  * Crear una nueva Entidad Educativa
  *
  * @param sfRequest $request A request object
  */
  public function executeNueva(sfWebRequest $request)
  {
    $this->form = new entidadEducativaForm();
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Entidades Educativas'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        $entidadEducativa = $usr->procesarFormulario($this->form, $request);
        $usr->setFlash('msg1', 'Entidad Educativa '.$entidadEducativa->getAbreviatura().' Agregada');
        $this->redirect('@actualizaEntidad?nombre='.$entidadEducativa->getNombre().'&id_entidad_educativa='.$entidadEducativa->getIdEntidadEducativa());
    }
    $this->setTemplate('form');
  }
  
  /**
  * Actualizar una Entidad Educativa Existente
  *
  * @param sfRequest $request A request object
  */
  public function executeActualiza(sfWebRequest $request)
  {
    $this->forward404Unless($entidad_educativa = Doctrine_Core::getTable('entidadEducativa')->find(array($request->getParameter('id_entidad_educativa'))), sprintf('Object entidad_educativa does not exist (%s).', $request->getParameter('id_entidad_educativa')));
    $this->form = new entidadEducativaForm($entidad_educativa);
    $usr = $this->getUser();
    $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Entidades Educatias'));
    if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
        $msg;
        if($entidadEducativa = $usr->procesarFormulario($this->form, $request)){
//            if($request->hasParameter('inhabilitar') == true){
//                $request->checkCSRFProtection();
//                $entidadEducativa->setHabilitado(FALSE);
//            }
            $msg = 'Entidad Educativa "'.$entidadEducativa->getAbreviatura().'" Actualizada';
        }
        else
            $msg = 'Problemas actualizando datos de"'.$entidadEducativa->getAbreviatura().'"';
        $usr->setFlash('msg', $msg);
    }
    $this->setTemplate('form');
  }
  
  /**
  * Agrega un Administrador a una Entidad Educativa
  *
  * @param sfRequest $request A request object
  */
  public function executeAgregaAdministrador(sfWebRequest $request)
  {
      $this->forward404Unless($entidadEducativa = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $request->getParameter('nombre')), sprintf('Object entidad_educativa does not exist (%s).', $request->getParameter('ee')));
      $usr = $this->getUser();
      $this->ee = $entidadEducativa;
      $usr->setFlash('msg', $usr->getFlash('msg1', 'Agregando Administrador a "'.$entidadEducativa->getAbreviatura().'"'));
      $this->form = new TipoPersonaForm();
      if($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName())){
          $msg;
          if($tipoPersona = $usr->procesarFormulario($this->form, $request)){
            $msg = '"'.$tipoPersona->getPersona()->getNombre().'" es el nuevo Administrador del "'.$tipoPersona->getEntidadEducativa()->getAbreviatura().'"';
          }
          else
            $msg = 'Error asignando Administrador a "'.$entidadEducativa->getAbreviatura().'"';  
          $usr->setFlash('msg', $msg);  
      }
  }
  /**
  * Opciones para Administrar una Entidad Educativa
  *
  * @param sfRequest $request A request object
  */
  public function executeAdmin(sfWebRequest $request)
  {
      $this->forward404Unless($entidadEducativa = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $request->getParameter('ee')), sprintf('Object entidad_educativa does not exist (%s).', $request->getParameter('ee')));
      $usr = $this->getUser();
      $usr->setFlash('msg', $usr->getFlash('msg1', 'Administrando "'.$entidadEducativa->getAbreviatura().'"'));
      $this->menu = array(
            array(
            'nombre'  => 'Agregar Administrador',
            'accion'  => 'agregaAdministrador',
            ),
//            array(
//            'nombre'  => 'Agregar Pago',
//            'accion'  => '@agregarPago?ee='.$entidadEducativa->getAbreviatura(),
//            ),
//            array(
//            'nombre'  => 'Ver Listado Pago',
//            'accion'  => '@agregarPago?ee='.$entidadEducativa->getAbreviatura(),
//            ),
        );
      $this->administrador = EntidadEducativaTable::getAdministradorEntidadEducativa($entidadEducativa->getIdEntidadEducativa());
      if(!is_null($this->administrador)){
          $this->menu[0]['nombre'] = 'Actualizar Administrador';
      }
      $this->ee = $entidadEducativa;
  }
}
