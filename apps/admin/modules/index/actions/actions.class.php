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
  * Entra a la aplicación
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
//    $this->forward('default', 'module');
    $usr = $this->getUser();
    $this->form = new iniciaSesionForm();
    $id_usuario = -1;
    $msg = 'Bienvenido, inicia sesión';
    if($usr->isAuthenticated()){
        $msg = 'Bienvenido '.$usr->getAttribute('nombrePersona');
        $id_usuario = $usr->getAttribute('idPersona');
    }elseif($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()) && $usr->procesarFormulario($this->form, $request, FALSE)){
        $id_usuario = $this->form->getValue('id_usuario');
    }else
        $usr->salir();
    if($persona = PersonaTable::getInstance()->find($id_usuario)){
        $msg = 'Bienvenido '.$persona->getNombre();
        $array = $usr->entrar($persona);
        $this->menu = $array['menu'];
        $this->entidadesEducativas = $array['entidadesEducativas'];
    }
    $usr->setFlash('msg', $usr->getFlash('msg1', $msg));
  }
  
  /**
  * Sale de la aplicación
  *
  * @param sfRequest $request A request object
  */
  public function executeSalir(sfWebRequest $request){
      $usr = $this->getUser();
      $usr->salir();
      $this->redirect('index/index');
  }
}
