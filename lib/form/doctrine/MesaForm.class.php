<?php

/**
 * Mesa form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MesaForm extends BaseMesaForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_mesa' => new sfWidgetFormInputText(),
      'id_tipo' => new sfWidgetFormDoctrineChoice(array('model' => 'Tipo','method' => 'getNombre', 'table_method' => 'getJornadas', 'add_empty' => true)),
      'nombre'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_mesa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_mesa')), 'empty_value' => $this->getObject()->get('id_mesa'), 'required' => false)),
      'id_tipo' => new sfValidatorDoctrineChoice(array('model' => 'Tipo')),
      'nombre'  => new sfValidatorString(array('max_length' => 30)),
    ));
    
    if($this->isNew()){
        $this->setValidator('id_mesa', new sfValidatorInteger());
    }
    
    $this->getWidgetSchema()->setLabels(array(
        'id_mesa' => 'Numero de la Mesa',
        'id_tipo' => 'Jornada',
        'nombre'  => 'Nombre de la mesa',
    ));

    $this->widgetSchema->setNameFormat('mesa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
