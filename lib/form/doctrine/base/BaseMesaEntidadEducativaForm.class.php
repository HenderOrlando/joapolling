<?php

/**
 * MesaEntidadEducativa form base class.
 *
 * @method MesaEntidadEducativa getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMesaEntidadEducativaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_entidad_educativa' => new sfWidgetFormInputHidden(),
      'id_mesa'              => new sfWidgetFormInputHidden(),
      'id_tipo_jornada'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'fecha_creado'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_entidad_educativa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_entidad_educativa')), 'empty_value' => $this->getObject()->get('id_entidad_educativa'), 'required' => false)),
      'id_mesa'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_mesa')), 'empty_value' => $this->getObject()->get('id_mesa'), 'required' => false)),
      'id_tipo_jornada'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('mesa_entidad_educativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MesaEntidadEducativa';
  }

}
