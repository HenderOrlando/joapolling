<?php

/**
 * Estudiante form base class.
 *
 * @method Estudiante getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CursosGrado'), 'add_empty' => false)),
      'id_estudiante' => new sfWidgetFormInputHidden(),
      'cod_curso'     => new sfWidgetFormInputText(),
      'fecha_creado'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_curso'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CursosGrado'))),
      'id_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estudiante')), 'empty_value' => $this->getObject()->get('id_estudiante'), 'required' => false)),
      'cod_curso'     => new sfValidatorInteger(),
      'fecha_creado'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('estudiante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

}
