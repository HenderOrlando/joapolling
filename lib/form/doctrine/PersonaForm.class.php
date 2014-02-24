<?php

/**
 * Persona form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonaForm extends BasePersonaForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_persona'   => new sfWidgetFormInputText(),
      'tipo_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'), 'method' => 'getNombre', 'table_method' => 'getTiposDocumentoIdentidad', 'add_empty' => true)),
      'nombre'       => new sfWidgetFormInputText(),
      'fecha_creado' => new sfWidgetFormInputHidden(),
      'clave'        => new sfWidgetFormInputPassword(),
      'clave1'       => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'id_persona'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_persona')), 'empty_value' => $this->getObject()->get('id_persona'), 'required' => false)),
      'tipo_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'nombre'       => new sfValidatorString(array('max_length' => 40)),
      'fecha_creado' => new sfValidatorDateTime(),
      'clave'        => new sfValidatorString(array('max_length' => 60)),
      'clave1'       => new sfValidatorString(array('max_length' => 60)),
    ));
    
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
        new sfValidatorSchemaCompare('clave', sfValidatorSchemaCompare::EQUAL, 'clave1', array('throw_global_error' => true), array('invalid' => "Las dos contraseñas no coinciden")),
//        new sfValidatorDoctrineUnique(array('model' => 'Persona', 'column' => array('nombres')), array('invalid'=> "Este email ya está en uso"))
    )));
    
    if($this->isNew()){
        $this->setDefault('fecha_creado', date('Y-m-d H:i:s'));
        $this->setValidator('id_persona', new sfValidatorInteger());
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }
    
    $this->getWidgetSchema()->setLabels(array(
        'id_persona'    => 'Numero de Documento de Identidad',
        'tipo_id'       => 'Tipo de Documento de Identidad',
        'nombre'        => 'Nombre',
        'fecha_creado'  => 'Fecha',
        'clave'         => 'Clave',
        'clave1'        => 'Repita Clave',
    ));
    
    $this->widgetSchema->setNameFormat('persona[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  public function  bind(array $taintedValues = null, array $taintedFiles = null) {
        if($taintedValues['clave'] == ''){
            if($this->isNew()){
                $taintedValues['clave'] = sha1($taintedValues['id_persona']);
                $taintedValues['clave1'] = sha1($taintedValues['id_persona']);
            }
            else{
                $taintedValues['clave'] = $this->getObject()->getClave();
                $taintedValues['clave1'] = $this->getObject()->getClave();
            }
        }else{
            $taintedValues['clave'] = sha1($taintedValues['clave']);
            $taintedValues['clave1'] = sha1($taintedValues['clave1']);
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
