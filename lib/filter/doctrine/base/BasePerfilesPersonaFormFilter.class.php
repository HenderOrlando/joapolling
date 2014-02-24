<?php

/**
 * PerfilesPersona filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePerfilesPersonaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EntidadEducativa'), 'add_empty' => true)),
      'fecha_creado'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EntidadEducativa'), 'column' => 'id_entidad_educativa')),
      'fecha_creado'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('perfiles_persona_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PerfilesPersona';
  }

  public function getFields()
  {
    return array(
      'id_persona'           => 'Number',
      'id_tipo_perfil'       => 'Number',
      'id_entidad_educativa' => 'ForeignKey',
      'fecha_creado'         => 'Date',
    );
  }
}
