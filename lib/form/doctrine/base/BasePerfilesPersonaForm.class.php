<?php

/**
 * PerfilesPersona form base class.
 *
 * @method PerfilesPersona getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePerfilesPersonaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_persona'           => new sfWidgetFormInputHidden(),
      'id_tipo_perfil'       => new sfWidgetFormInputHidden(),
      'id_entidad_educativa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EntidadEducativa'), 'add_empty' => false)),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_persona'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_persona')), 'empty_value' => $this->getObject()->get('id_persona'), 'required' => false)),
      'id_tipo_perfil'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_perfil')), 'empty_value' => $this->getObject()->get('id_tipo_perfil'), 'required' => false)),
      'id_entidad_educativa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EntidadEducativa'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('perfiles_persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PerfilesPersona';
  }

}
