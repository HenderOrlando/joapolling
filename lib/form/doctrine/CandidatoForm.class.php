<?php

/**
 * Candidato form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CandidatoForm extends BaseCandidatoForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_candidato'            => new sfWidgetFormChoice(array('choices' => VotanteTable::getVotantesArray(true))),
//      'id_candidato'            => new sfWidgetFormChoice(array('choices' => VotanteTable::getVotantesArray())),
      'no'                      => new sfWidgetFormInputText(),
      'foto'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'method' => 'getNombreArchivo', 'table_method' => 'getFotos', 'add_empty' => true)),
      'votos'                   => new sfWidgetFormInputHidden(),
      'id_tipo_eleccion'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'method' => 'getNombre', 'table_method' => 'getTiposElecciones', 'add_empty' => true)),
      'id_candidato_representa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Candidato'), 'method' => 'getNombre', 'add_empty' => true)),
      'fecha_creado'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_candidato'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Votante'))),
      'no'                      => new sfValidatorInteger(),
      //'foto'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ArchivosEntidadEducativa'), 'required' => false)),
      'foto'                    => new sfValidatorInteger(),
      'votos'                   => new sfValidatorInteger(array('required' => false)),
      'id_tipo_eleccion'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'id_candidato_representa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Votante'), 'required' => false)),
      'fecha_creado'            => new sfValidatorDateTime(),
    ));
    
    $this->getWidgetSchema()->setLabels(array(
        'id_candidato'            => 'Votante',
        'no'                      => 'Numero del Candidato',
        'foto'                    => 'Foto del Votante',
        'votos'                   => 'Numero de Votos',
        'id_tipo'                 => 'Candidato para ',
        'id_candidato_representa' => 'Representa a ',
        'fecha_creado'            => 'Fecha',
    ));
    
    if($this->isNew()){
        $this->setDefault('fecha_creado', date('Y-m-d H:m:s'));
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }

    $this->widgetSchema->setNameFormat('candidato[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  public function  bind(array $taintedValues = null, array $taintedFiles = null) {
        if($taintedValues['id_candidato_representa'] == ""){
            if($this->isNew()){
                $taintedValues['id_candidato_representa'] = $taintedValues['id_candidato'];
            }
            else{
                $taintedValues['id_candidato_representa'] = $this->getObject()->getCandidato();
            }
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
