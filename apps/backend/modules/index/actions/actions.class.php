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
    $this->form = new iniciaSesionAdminColegioForm();
    $id_usuario = -1;
    $id_entidad = $request->getParameter('abreviatura','-1');
    $msg = 'Bienvenido';
    if($id_entidad != -1){
        $this->ee = $id_entidad;
        if($entidad = EntidadEducativaTable::getInstance()->findOneBy('abreviatura', $id_entidad)){
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
        $msg .= ' "'.$usr->getAttribute('nombrePersona').'"';
        $id_usuario = $usr->getAttribute('idPersona');
        $id_entidad = $usr->getAttribute('idEntidadEducativa');
    }
    elseif($request->isMethod(sfRequest::POST) && $request->hasParameter($this->form->getName()) && $usr->procesarFormulario($this->form, $request, FALSE)){
        $id_usuario = $this->form->getValue('id_usuario');
        $id_entidad = $this->form->getValue('entidad_educativa');
    }
    
    if($persona = PersonaTable::getInstance()->find($id_usuario)){
        $tipoPersona = $persona->hasTipo(4,true);
        if((!is_bool($tipoPersona) && $tipoPersona->getIdEntidadEducativa() == $id_entidad && $persona->getClave() == $this->form->getValue('password')) || $usr->isAuthenticated()){
            if(count_chars($msg) <= 10)
                $msg .= ' "'.$persona->getNombre().'"';
            if($entidad = $persona->isEntidadEducativa($id_entidad, true)){
                $array = $usr->entrar($persona, $entidad);
                $this->menu = $array['menu'];
                $usr->setFlash('msg1', $msg);
                if(!$request->hasParameter('ee'))
                    $this->redirect('@homepageEntidadEducativa?abreviatura='.$entidad->getAbreviatura().'&ee=0');
            }
        }else{
            $msg = 'Usuario o contraseña incorrectas';
        }
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
      $usr->setFlash('msg1', 'Sesión finalizada');
      $this->redirect('@homepageEntidadEducativa?abreviatura='.$request->getParameter('abreviatura'));
  }
}
