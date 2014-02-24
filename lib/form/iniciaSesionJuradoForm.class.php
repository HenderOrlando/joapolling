<?php

/**
 * iniciaSesionColegio form base class.
 *
 * @method iniciaSesionColegio getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */

class iniciaSesionJuradoForm extends sfForm
{
  public function configure()
  {
    $msg = array('invalid' => 'Invalido','required' => 'Requerido');
    $this->setWidgets(array(
      'entidad_educativa'  => new sfWidgetFormDoctrineChoice(array('model' => 'EntidadEducativa', 'method' => 'getAbreviatura', 'table_method' => 'getEntidadesEducativas')),
      'jornada'            => new sfWidgetFormDoctrineChoice(array('model' => 'Tipo', 'method' => 'getNombre', 'table_method' => 'getJornadas')),
      'mesa'               => new sfWidgetFormDoctrineChoice(array('model' => 'Mesa', 'method' => 'getNombre')),
      'cargo'              => new sfWidgetFormDoctrineChoice(array('model' => 'Tipo', 'method' => 'getNombre', 'table_method' => 'getTiposJurado')),
      'doc_id'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'entidad_educativa'  => new sfValidatorDoctrineChoice(array('model' => 'EntidadEducativa') , $msg),
      'doc_id'             => new sfValidatorDoctrineChoice(array('model' => 'Jurado') , $msg),
      'jornada'            => new sfValidatorDoctrineChoice(array('model' => 'Tipo') , $msg),
      'mesa'               => new sfValidatorDoctrineChoice(array('model' => 'Mesa') , $msg),
      'cargo'              => new sfValidatorDoctrineChoice(array('model' => 'Tipo') , $msg),
    ));

    $this->widgetSchema->setLabels(array(
      'entidad_educativa'  => 'Entidad Educativa',
      'doc_id'             => 'No Documento de Identidad',
      'jornada'            => 'Jornada asignada',
      'mesa'               => 'No de Mesa',
      'cargo'              => 'Cargo en la Mesa',
    ));

    $this->widgetSchema->setFormFormatterName('table');

    $this->widgetSchema->setNameFormat('iniciaSesionColegio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }

}
