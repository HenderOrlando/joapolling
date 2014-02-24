<?php

/**
 * CursosGrado form base class.
 *
 * @method CursosGrado getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCursosGradoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso_grado'       => new sfWidgetFormInputHidden(),
      'id_curso'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => false)),
      'id_grado'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa'), 'add_empty' => false)),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa_3'), 'add_empty' => false)),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_curso_grado'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_curso_grado')), 'empty_value' => $this->getObject()->get('id_curso_grado'), 'required' => false)),
      'id_curso'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'))),
      'id_grado'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa'))),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa_3'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cursos_grado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursosGrado';
  }

}
