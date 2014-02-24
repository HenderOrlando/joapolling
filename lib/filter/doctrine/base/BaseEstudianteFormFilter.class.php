<?php

/**
 * Estudiante filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_curso'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CursosGrado'), 'add_empty' => true)),
      'cod_curso'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_creado'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_curso'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CursosGrado'), 'column' => 'id_curso_grado')),
      'cod_curso'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_creado'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('estudiante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

  public function getFields()
  {
    return array(
      'id_curso'      => 'ForeignKey',
      'id_estudiante' => 'Number',
      'cod_curso'     => 'Number',
      'fecha_creado'  => 'Date',
    );
  }
}
