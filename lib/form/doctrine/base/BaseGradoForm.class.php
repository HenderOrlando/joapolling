<?php

/**
 * Grado form base class.
 *
 * @method Grado getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGradoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_grado'     => new sfWidgetFormInputHidden(),
      'abreviatura'  => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'fecha_creado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_grado'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grado')), 'empty_value' => $this->getObject()->get('id_grado'), 'required' => false)),
      'abreviatura'  => new sfValidatorString(array('max_length' => 3)),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'fecha_creado' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('grado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grado';
  }

}
