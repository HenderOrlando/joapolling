<?php

/**
 * Estudiante filter form.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EstudianteFormFilter extends BaseEstudianteFormFilter
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_grupo'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Grupo'), 'method' => 'getNombre', 'add_empty' => FALSE)),
      'cod_grupo'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_grupo'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Grupo'), 'column' => 'id_grupo')),
      'cod_grupo'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
        'id_grupo'  => 'Grupo',
        'cod_grupo'  => 'Código'
    ));

    $this->widgetSchema->setNameFormat('estudiante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();
  }
}
