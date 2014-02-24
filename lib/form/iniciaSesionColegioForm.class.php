<?php

/**
 * iniciaSesionColegio form base class.
 *
 * @method iniciaSesionColegio getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */

class iniciaSesionColegioForm extends sfForm
{
  public function configure()
  {
    $msg = array('invalid' => 'Invalido','required' => 'Requerido');
    $this->setWidgets(array(
      'entidad_educativa'  => new sfWidgetFormDoctrineChoice(array('model' => 'EntidadEducativa', 'method' => 'getAbreviatura', 'table_method' => 'getEntidadesEducativas')),
      'curso'              => new sfWidgetFormDoctrineChoice(array('model' => 'CursosGrado', 'method' => 'getNombre')),
      'codigo'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'entidad_educativa'  => new sfValidatorDoctrineChoice(array('model' => 'EntidadEducativa') , $msg),
      'curso'              => new sfValidatorDoctrineChoice(array('model' => 'CursosGrado') , $msg),
      'codigo'             => new sfValidatorInteger(array(), $msg)
    ));

//    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
//        new sfValidatorSchema(array('curso'  => new sfValidatorChoice(array('choices' => PersonasEntidadEducativaTable::getGrupos($this->getValue('entidad_educativa'))), $msg)), array(), $msg),
//        new sfValidatorSchema(array('codigo' => new sfValidatorChoice(array('choices' => PersonasEntidadEducativaTable::getCodigosEstudiante($this->getValue('entidad_educativa'))), $msg)), array(), $msg),
//    )));

    $this->widgetSchema->setLabels(array(
        'entidad_educativa'  => 'Entidad Educativa',
        'curso'    => 'Curso',
        'codigo'    => 'Código',
    ));

    $this->widgetSchema->setFormFormatterName('table');

    $this->widgetSchema->setNameFormat('iniciaSesionColegio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }

}
