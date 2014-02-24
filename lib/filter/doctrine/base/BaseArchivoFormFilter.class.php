<?php

/**
 * Archivo filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'src'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'extension'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'src'        => new sfValidatorPass(array('required' => false)),
      'extension'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Archivo';
  }

  public function getFields()
  {
    return array(
      'id_archivo' => 'Number',
      'nombre'     => 'Text',
      'src'        => 'Text',
      'extension'  => 'Text',
    );
  }
}
