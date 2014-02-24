<?php

/**
 * GradoEntidadEducativa form base class.
 *
 * @method GradoEntidadEducativa getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGradoEntidadEducativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_grado'             => new sfWidgetFormInputHidden(),
      'id_entidad_educativa' => new sfWidgetFormInputHidden(),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_grado'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grado')), 'empty_value' => $this->getObject()->get('id_grado'), 'required' => false)),
      'id_entidad_educativa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_entidad_educativa')), 'empty_value' => $this->getObject()->get('id_entidad_educativa'), 'required' => false)),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('grado_entidad_educativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GradoEntidadEducativa';
  }

}
