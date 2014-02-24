<?php

/**
 * Candidato form base class.
 *
 * @method Candidato getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCandidatoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_candidato'            => new sfWidgetFormInputHidden(),
      'no'                      => new sfWidgetFormInputText(),
      'foto'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'add_empty' => true)),
      'votos'                   => new sfWidgetFormInputText(),
      'id_tipo_eleccion'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'add_empty' => false)),
      'id_candidato_representa' => new sfWidgetFormInputText(),
      'fecha_creado'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_candidato'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_candidato')), 'empty_value' => $this->getObject()->get('id_candidato'), 'required' => false)),
      'no'                      => new sfValidatorInteger(),
      'foto'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'required' => false)),
      'votos'                   => new sfValidatorInteger(array('required' => false)),
      'id_tipo_eleccion'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'id_candidato_representa' => new sfValidatorInteger(array('required' => false)),
      'fecha_creado'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('candidato[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Candidato';
  }

}
