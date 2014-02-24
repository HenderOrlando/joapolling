<?php

/**
 * Curso form base class.
 *
 * @method Curso getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'     => new sfWidgetFormInputHidden(),
      'nombre'       => new sfWidgetFormInputText(),
      'abreviatura'  => new sfWidgetFormInputText(),
      'fecha_creado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_curso'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_curso')), 'empty_value' => $this->getObject()->get('id_curso'), 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'abreviatura'  => new sfValidatorString(array('max_length' => 3)),
      'fecha_creado' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Curso';
  }

}
