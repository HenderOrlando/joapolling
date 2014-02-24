<?php

/**
 * Votante filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseVotanteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'voto'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_voto'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa'), 'add_empty' => true)),
      'id_mesa'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaEntidadEducativa_4'), 'add_empty' => true)),
      'habilitado'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ingreso_votar'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_eleccion'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'voto'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_voto'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesaEntidadEducativa'), 'column' => 'id_entidad_educativa')),
      'id_mesa'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesaEntidadEducativa_4'), 'column' => 'id_entidad_educativa')),
      'habilitado'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ingreso_votar'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_eleccion'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id_tipo')),
    ));

    $this->widgetSchema->setNameFormat('votante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Votante';
  }

  public function getFields()
  {
    return array(
      'id_votante'           => 'Number',
      'voto'                 => 'Number',
      'fecha_voto'           => 'Date',
      'id_entidad_educativa' => 'ForeignKey',
      'id_mesa'              => 'ForeignKey',
      'habilitado'           => 'Number',
      'ingreso_votar'        => 'Number',
      'id_tipo_eleccion'     => 'ForeignKey',
    );
  }
}
