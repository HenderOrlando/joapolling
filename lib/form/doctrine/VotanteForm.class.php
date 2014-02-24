<?php

/**
 * Votante form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class VotanteForm extends BaseVotanteForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_votante'          => new sfWidgetFormDoctrineChoice(array('model' => 'Persona', 'method' => 'getNombre', 'add_empty' => true)),
      'voto'                => new sfWidgetFormInputHidden(),
      'fecha_voto'          => new sfWidgetFormInputHidden(),
      'id_mesa'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'), 'method' => 'getNombreMesa', 'add_empty' => true)),
      'id_entidad_Educativa'=> new sfWidgetFormInputHidden(),
      'habilitado'          => new sfWidgetFormInputHidden(),
      'id_tipo_eleccion'    => new sfWidgetFormInputHidden(),
      'ingreso_votar'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_votante'           => new sfValidatorDoctrineChoice(array('model' => 'Persona', 'required' => false)),
      'voto'                 => new sfValidatorInteger(array('required' => false)),
      'fecha_voto'           => new sfValidatorDateTime(array('required' => false)),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'))),
      'id_mesa'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_4'))),
      'habilitado'           => new sfValidatorInteger(array('required' => false)),
      'ingreso_votar'        => new sfValidatorInteger(array('required' => false)),
      'id_tipo_eleccion'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
      'id_votante'      => 'Votante',
      'voto'            => 'Ya votó?',
      'fecha_voto'      => 'Fecha',
      'id_mesa'         => 'Mesa donde votar',
      'habilitado'      => 'Puede votar?',
      'ingreso_votar'   => 'Ya ingresó para votar?',
      'id_tipo_eleccion'=> 'Elección de'
    ));
    
    if($this->isNew()){
        $this->setDefault('id_tipo_eleccion', 17);
    }else{
        $this->setDefault('id_tipo_eleccion', $this->getObject()->getIdTipoEleccion());
        $this->setDefault('id_entidad_educativa', $this->getObject()->getIdEntidadEducativa());
    }

    $this->widgetSchema->setNameFormat('votante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
