<?php

/**
 * Votante form base class.
 *
 * @method Votante getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVotanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_votante'           => new sfWidgetFormInputHidden(),
      'voto'                 => new sfWidgetFormInputText(),
      'fecha_voto'           => new sfWidgetFormDateTime(),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'), 'add_empty' => false)),
      'id_mesa'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_4'), 'add_empty' => false)),
      'habilitado'           => new sfWidgetFormInputText(),
      'ingreso_votar'        => new sfWidgetFormInputText(),
      'id_tipo_eleccion'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_votante'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_votante')), 'empty_value' => $this->getObject()->get('id_votante'), 'required' => false)),
      'voto'                 => new sfValidatorInteger(array('required' => false)),
      'fecha_voto'           => new sfValidatorDateTime(array('required' => false)),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'))),
      'id_mesa'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_4'))),
      'habilitado'           => new sfValidatorInteger(array('required' => false)),
      'ingreso_votar'        => new sfValidatorInteger(array('required' => false)),
      'id_tipo_eleccion'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
    ));

    $this->widgetSchema->setNameFormat('votante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Votante';
  }

}
