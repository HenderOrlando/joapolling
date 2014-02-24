<?php

/**
 * EntidadEducativa form base class.
 *
 * @method EntidadEducativa getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntidadEducativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_entidad_educativa'      => new sfWidgetFormInputHidden(),
      'nombre'                    => new sfWidgetFormInputText(),
      'abreviatura'               => new sfWidgetFormInputText(),
      'id_tipo_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'fecha_creado'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_entidad_educativa'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_entidad_educativa')), 'empty_value' => $this->getObject()->get('id_entidad_educativa'), 'required' => false)),
      'nombre'                    => new sfValidatorString(array('max_length' => 64)),
      'abreviatura'               => new sfValidatorString(array('max_length' => 15)),
      'id_tipo_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('entidad_educativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EntidadEducativa';
  }

}
