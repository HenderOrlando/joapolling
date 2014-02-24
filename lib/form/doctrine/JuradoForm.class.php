<?php

/**
 * Jurado form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JuradoForm extends BaseJuradoForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_jurado'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Persona'), 'method' => 'getNombre', 'add_empty' => true)),
      'id_tipo'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'method' => 'getNombre', 'table_method' => 'getTiposJurado', 'add_empty' => true)),
      'id_mesa'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mesa'), 'method' => 'getNombre', 'add_empty' => true)),
      'fecha_creado' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_mesa'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mesa'))),
      'id_tipo'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'id_jurado'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_jurado')), 'empty_value' => $this->getObject()->get('id_jurado'), 'required' => false)),
      'fecha_creado' => new sfValidatorDateTime(),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
        'id_mesa'      => 'Mesa',
        'id_tipo'      => 'Posición del Jurado',
        'id_jurado'    => 'Jurado',
        'fecha_creado' => 'Fecha',
    ));
    
    if($this->isNew()){
        $this->getWidgetSchema()->setDefault('fecha_creado', date('Y-m-d H:i:s'));
    }else{
        $this->getWidgetSchema()->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }

    $this->widgetSchema->setNameFormat('jurado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
