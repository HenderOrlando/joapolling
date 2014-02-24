<?php

/**
 * CursosGrado filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCursosGradoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'id_grado'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa'), 'add_empty' => true)),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GradoEntidadEducativa_3'), 'add_empty' => true)),
      'fecha_creado'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_curso'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id_curso')),
      'id_grado'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GradoEntidadEducativa'), 'column' => 'id_grado')),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('GradoEntidadEducativa_3'), 'column' => 'id_grado')),
      'fecha_creado'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cursos_grado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CursosGrado';
  }

  public function getFields()
  {
    return array(
      'id_curso_grado'       => 'Number',
      'id_curso'             => 'ForeignKey',
      'id_grado'             => 'ForeignKey',
      'id_entidad_educativa' => 'ForeignKey',
      'fecha_creado'         => 'Date',
    );
  }
}
