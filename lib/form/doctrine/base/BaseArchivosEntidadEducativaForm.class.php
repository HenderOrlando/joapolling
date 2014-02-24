<?php

/**
 * ArchivosEntidadEducativa form base class.
 *
 * @method ArchivosEntidadEducativa getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArchivosEntidadEducativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_entidad_educativa' => new sfWidgetFormInputHidden(),
      'id_archivo'           => new sfWidgetFormInputHidden(),
      'id_tipo_uso'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_entidad_educativa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_entidad_educativa')), 'empty_value' => $this->getObject()->get('id_entidad_educativa'), 'required' => false)),
      'id_archivo'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_archivo')), 'empty_value' => $this->getObject()->get('id_archivo'), 'required' => false)),
      'id_tipo_uso'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('archivos_entidad_educativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArchivosEntidadEducativa';
  }

}
