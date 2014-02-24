<?php

/**
 * Estudiante form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EstudianteForm extends BaseEstudianteForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_estudiante' => new sfWidgetFormDoctrineChoice(array('model' => 'Persona', 'method' => 'getNombre', 'add_empty' => true)),
      'id_curso'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CursosGrado'), 'method' => 'getNombre', 'add_empty' => true)),
      'cod_curso'     => new sfWidgetFormInputText(),
      'fecha_creado'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_estudiante' => new sfValidatorDoctrineChoice(array('model' => 'Persona', 'required' => false)),
      'id_curso'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CursosGrado'))),
      'cod_curso'     => new sfValidatorInteger(),
      'fecha_creado'  => new sfValidatorDateTime(),
    ));
    
    if($this->isNew()){
        $this->setDefault('fecha_creado', date('Y-m-d H:i:s'));
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }
    
    $this->getWidgetSchema()->setLabels(array(
        'id_estudiante' => 'Persona',
        'id_grupo'      => 'Grupo',
        'cod_grupo'     => 'Codigo en el grupo',
        'fecha_creado'  => 'Fecha',
    ));

    $this->widgetSchema->setNameFormat('estudiante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
