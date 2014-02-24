<?php

/**
 * Persona form base class.
 *
 * @method Persona getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_persona'   => new sfWidgetFormInputHidden(),
      'tipo_doc_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'nombre'       => new sfWidgetFormInputText(),
      'clave'        => new sfWidgetFormInputText(),
      'fecha_creado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_persona'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_persona')), 'empty_value' => $this->getObject()->get('id_persona'), 'required' => false)),
      'tipo_doc_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'nombre'       => new sfValidatorString(array('max_length' => 40)),
      'clave'        => new sfValidatorString(array('max_length' => 60)),
      'fecha_creado' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Persona';
  }

}
