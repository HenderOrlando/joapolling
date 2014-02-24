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

class iniciaSesionAdminColegioForm extends sfForm
{
  public function configure()
  {
    $msg = array('invalid' => 'Invalido','required' => 'Requerido');
    $this->setWidgets(array(
      'entidad_educativa'  => new sfWidgetFormDoctrineChoice(array('model' => 'EntidadEducativa', 'method' => 'getAbreviatura', 'table_method' => 'getEntidadesEducativas')),
      'id_usuario'         => new sfWidgetFormInputText(),
      'password'           => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'entidad_educativa'  => new sfValidatorDoctrineChoice(array('model' => 'EntidadEducativa') , $msg),
      'id_usuario'         => new sfValidatorChoice(array('choices' => PersonaTable::getArrayAdmins(true)), $msg),
      'password'           => new sfValidatorPass(array(), $msg)
    ));

    $this->widgetSchema->setLabels(array(
        'id_usuario'        => 'Identicación de Usuario',
        'password'          => 'Contraseña',
        'entidad_educativa' => 'Entidad Educativa'
    ));

    $this->widgetSchema->setFormFormatterName('table');

    $this->widgetSchema->setNameFormat('iniciaSesionColegio[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }
  
  public function getValue($field) {
      $var = parent::getValue($field);
      if($field === 'password')
          $var = sha1 ($var);
      return $var;
  }

}
