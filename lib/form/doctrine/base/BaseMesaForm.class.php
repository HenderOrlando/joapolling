<?php

/**
 * Mesa form base class.
 *
 * @method Mesa getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMesaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_mesa'      => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'fecha_creado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_mesa'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_mesa')), 'empty_value' => $this->getObject()->get('id_mesa'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'fecha_creado' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('mesa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mesa';
  }

}
