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

class cargaDatosForm extends sfForm
{
  public function configure()
  {
    $msg = array('invalid' => 'Invalido','required' => 'Requerido');
    $this->setWidgets(array(
      'archivo'    => new sfWidgetFormInputFile(array(), array('class' => 'ui-button')),
    ));

    $this->setValidators(array(
      'archivo'     => new sfValidatorFile(array() , $msg),
    ));

    $this->widgetSchema->setLabels(array(
        'archivo'   => 'Archivo',
    ));

    $this->widgetSchema->setFormFormatterName('table');

    $this->widgetSchema->setNameFormat('cargaDatos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }

}
?>
