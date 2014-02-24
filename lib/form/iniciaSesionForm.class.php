<?php

/**
 * iniciaSesion form base class.
 *
 * @method iniciaSesion getObject() Returns the current form's model object
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */

class iniciaSesionForm extends sfForm
{
  public function configure()
  {
    $msg = array('invalid' => 'Invalido','required' => 'Requerido');
    $this->setWidgets(array(
      'id_usuario'  => new sfWidgetFormInputText(),
      'password'    => new sfWidgetFormInputPassword(),
    ));

    $this->setValidators(array(
      'id_usuario'  => new sfValidatorChoice(array('choices' => PersonaTable::getArraySuperAdmins(true)), $msg),
      'password'    => new sfValidatorPass(array(), $msg)
    ));

    $this->widgetSchema->setLabels(array(
        'id_usuario'  => 'Identificación del Usuario',
        'password'    => 'Contraseña',
    ));

    $this->widgetSchema->setFormFormatterName('table');

    $this->widgetSchema->setNameFormat('iniciaSesion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }
  
  public function getValue($field) {
      $var = parent::getValue($field);
      if($field === 'password')
          $var = sha1 ($var);
      return $var;
  }

}
