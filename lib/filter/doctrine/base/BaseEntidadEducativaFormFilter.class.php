<?php

/**
 * EntidadEducativa filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEntidadEducativaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'abreviatura'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'fecha_creado'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'                    => new sfValidatorPass(array('required' => false)),
      'abreviatura'               => new sfValidatorPass(array('required' => false)),
      'id_tipo_entidad_educativa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id_tipo')),
      'fecha_creado'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('entidad_educativa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EntidadEducativa';
  }

  public function getFields()
  {
    return array(
      'id_entidad_educativa'      => 'Number',
      'nombre'                    => 'Text',
      'abreviatura'               => 'Text',
      'id_tipo_entidad_educativa' => 'ForeignKey',
      'fecha_creado'              => 'Date',
    );
  }
}
