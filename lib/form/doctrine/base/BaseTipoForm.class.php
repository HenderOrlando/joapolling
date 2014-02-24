<?php

/**
 * Tipo form base class.
 *
 * @method Tipo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo'      => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'descripcion'  => new sfWidgetFormTextarea(),
      'fecha_creado' => new sfWidgetFormDateTime(),
      'objeto'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_tipo'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo')), 'empty_value' => $this->getObject()->get('id_tipo'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'descripcion'  => new sfValidatorString(),
      'fecha_creado' => new sfValidatorDateTime(),
      'objeto'       => new sfValidatorString(array('max_length' => 30)),
    ));

    $this->widgetSchema->setNameFormat('tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipo';
  }

}
