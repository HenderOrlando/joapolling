<?php

/**
 * Archivo form base class.
 *
 * @method Archivo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_archivo' => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'src'        => new sfWidgetFormInputText(),
      'extension'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_archivo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_archivo')), 'empty_value' => $this->getObject()->get('id_archivo'), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 30)),
      'src'        => new sfValidatorString(array('max_length' => 120)),
      'extension'  => new sfValidatorString(array('max_length' => 5)),
    ));

    $this->widgetSchema->setNameFormat('archivo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo';
  }

}
