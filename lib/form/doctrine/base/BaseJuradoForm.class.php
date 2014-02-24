<?php

/**
 * Jurado form base class.
 *
 * @method Jurado getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJuradoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_jurado'            => new sfWidgetFormInputHidden(),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'), 'add_empty' => false)),
      'id_mesa'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_3'), 'add_empty' => false)),
      'id_tipo_jurado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_jurado'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_jurado')), 'empty_value' => $this->getObject()->get('id_jurado'), 'required' => false)),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'))),
      'id_mesa'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_3'))),
      'id_tipo_jurado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('jurado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Jurado';
  }

}
