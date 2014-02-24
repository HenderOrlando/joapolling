<?php

/**
 * PerfilesPersona form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PerfilesPersonaForm extends BasePerfilesPersonaForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'id_persona'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Persona'), 'method' => 'getNombre', 'add_empty' => true)),
      'id_tipo_perfil'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'method' => 'getNombre', 'add_empty' => true, 'table_method' => 'getPerfiles')),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EntidadEducativa'), 'method' => 'getNombre', 'add_empty' => true, 'table_method' => 'getEntidadesEducativas')),
      'fecha_creado'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_persona'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Persona'))),
      'id_tipo_perfil'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EntidadEducativa'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));
    
    if($this->isNew()){
        $this->setDefault('fecha_creado', date('Y-m-d H:i:s'));
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }
    
    $this->getWidgetSchema()->setLabels(array(
        'id_persona'           => 'Persona a Agregar a la Entidad Educativa',
        'id_entidad_educativa' => 'Entidad Educativa donde Agregar a la Persona',
        'fecha_creado'         => 'Fecha',
    ));

    $this->widgetSchema->setNameFormat('perfiles_persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
