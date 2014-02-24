<?php

/**
 * Grupo form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoForm extends BaseGrupoForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_grupo'     => new sfWidgetFormInputHidden(),
      'no_grupo'     => new sfWidgetFormInputText(),
      'nombre'       => new sfWidgetFormInputText(),
      'id_curso'     => new sfWidgetFormInputText(),
      'id_tipo'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'),'method' => 'getNombre', 'table_method' => 'getJornadas', 'add_empty' => true)),
      'fecha_creado' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_grupo'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grupo')), 'empty_value' => $this->getObject()->get('id_grupo'), 'required' => false)),
      'no_grupo'     => new sfValidatorString(array('max_length' => 3),array('max_length' => 'Longitud Máxima de 3 ')),
      'nombre'       => new sfValidatorString(array('max_length' => 30)),
      'id_curso'     => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'id_tipo'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado' => new sfValidatorDateTime(),
    ));
    
    if($this->isNew()){
        $this->setValidator('id_grupo', new sfValidatorInteger(array('required' => false)));
        $this->setDefault('fecha_creado', date('Y-m-d H:i:s'));
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }
    $this->getWidgetSchema()->setLabels(array(
        'id_grupo'   => 'Identificador',
        'no_grupo'     => 'Numero o 3 primeras letras',
        'nombre'       => 'Nombre del Grupo',
        'id_curso'     => 'Letra o Número del Curso',
        'id_tipo'      => 'Jornada',
        'fecha_creado' => 'Fecha',
    ));

    $this->widgetSchema->setNameFormat('grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
