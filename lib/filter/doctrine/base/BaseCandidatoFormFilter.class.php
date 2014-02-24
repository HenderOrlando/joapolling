<?php

/**
 * Candidato filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCandidatoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'no'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'foto'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'add_empty' => true)),
      'votos'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_eleccion'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => true)),
      'id_candidato_representa' => new sfWidgetFormFilterInput(),
      'fecha_creado'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'no'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'foto'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'column' => 'id_entidad_educativa')),
      'votos'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_eleccion'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tipo'), 'column' => 'id_tipo')),
      'id_candidato_representa' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_creado'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('candidato_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Candidato';
  }

  public function getFields()
  {
    return array(
      'id_candidato'            => 'Number',
      'no'                      => 'Number',
      'foto'                    => 'ForeignKey',
      'votos'                   => 'Number',
      'id_tipo_eleccion'        => 'ForeignKey',
      'id_candidato_representa' => 'Number',
      'fecha_creado'            => 'Date',
    );
  }
}
