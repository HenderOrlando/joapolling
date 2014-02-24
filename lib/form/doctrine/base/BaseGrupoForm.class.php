<?php

/**
 * Grupo form base class.
 *
 * @method Grupo getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_grupo'     => new sfWidgetFormInputHidden(),
      'no_grupo'     => new sfWidgetFormInputText(),
      'id_curso'     => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'id_tipo'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'fecha_creado' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_grupo'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grupo')), 'empty_value' => $this->getObject()->get('id_grupo'), 'required' => false)),
      'no_grupo'     => new sfValidatorString(array('max_length' => 3)),
      'id_curso'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'id_tipo'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupo';
  }

}
