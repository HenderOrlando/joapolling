<?php

/**
 * EntidadEducativa form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EntidadEducativaForm extends BaseEntidadEducativaForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'id_entidad_educativa' => new sfWidgetFormInputText(),
      'id_tipo'              => new sfWidgetFormChoice(array('choices' => TipoTable::getArrayTipoObjeto(array('empty' => true, 'objeto' => 'entidad_educativa')))),
      'nombre'               => new sfWidgetFormInputText(),
      'abreviatura'          => new sfWidgetFormInputText(),
      'fecha_creado'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_entidad_educativa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_entidad_educativa')), 'empty_value' => $this->getObject()->get('id_entidad_educativa'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 64)),
      'abreviatura'          => new sfValidatorString(array('max_length' => 15)),
      'id_tipo'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tipo'))),
      'fecha_creado'         => new sfValidatorDateTime(),
    ));
    
    if($this->isNew()){
        $this->setDefault('fecha_creado', date('Y-m-d H:i:s'));
        $this->setValidator('id_entidad_educativa', new sfValidatorInteger());
    }else{
        $this->setDefault('fecha_creado', $this->getObject()->getFechaCreado());
    }
    
    $this->getWidgetSchema()->setLabels(array(
      'id_entidad_educativa' => 'No de Idenificación',
      'nombre'               => 'Nombre',
      'abreviatura'          => 'Abreviatura',
      'id_tipo'              => 'Tipo',
      'fecha_creado'         => 'Fecha',
    ));

    $this->widgetSchema->setNameFormat('entidad_educativa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  public function  bind(array $taintedValues = null, array $taintedFiles = null) {
        if($taintedValues['id_entidad_educativa'] == ''){
            do{
                $i = EntidadEducativaTable::getInstance()->count()+1;
                $entidadEducativa = EntidadEducativaTable::getInstance()->find($i);
                $taintedValues['id_entidad_educativa'] = $i;
                $i++;
            }while($entidadEducativa);
                
        }
        parent::bind($taintedValues, $taintedFiles);
    }
}
