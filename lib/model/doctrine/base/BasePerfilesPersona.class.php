<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PerfilesPersona', 'doctrine');

/**
 * BasePerfilesPersona
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_persona
 * @property integer $id_tipo_perfil
 * @property integer $id_entidad_educativa
 * @property timestamp $fecha_creado
 * @property Persona $Persona
 * @property EntidadEducativa $EntidadEducativa
 * @property Tipo $Tipo
 * 
 * @method integer          getIdPersona()            Returns the current record's "id_persona" value
 * @method integer          getIdTipoPerfil()         Returns the current record's "id_tipo_perfil" value
 * @method integer          getIdEntidadEducativa()   Returns the current record's "id_entidad_educativa" value
 * @method timestamp        getFechaCreado()          Returns the current record's "fecha_creado" value
 * @method Persona          getPersona()              Returns the current record's "Persona" value
 * @method EntidadEducativa getEntidadEducativa()     Returns the current record's "EntidadEducativa" value
 * @method Tipo             getTipo()                 Returns the current record's "Tipo" value
 * @method PerfilesPersona  setIdPersona()            Sets the current record's "id_persona" value
 * @method PerfilesPersona  setIdTipoPerfil()         Sets the current record's "id_tipo_perfil" value
 * @method PerfilesPersona  setIdEntidadEducativa()   Sets the current record's "id_entidad_educativa" value
 * @method PerfilesPersona  setFechaCreado()          Sets the current record's "fecha_creado" value
 * @method PerfilesPersona  setPersona()              Sets the current record's "Persona" value
 * @method PerfilesPersona  setEntidadEducativa()     Sets the current record's "EntidadEducativa" value
 * @method PerfilesPersona  setTipo()                 Sets the current record's "Tipo" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePerfilesPersona extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('perfiles_persona');
        $this->hasColumn('id_persona', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_perfil', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_entidad_educativa', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('fecha_creado', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Persona', array(
             'local' => 'id_persona',
             'foreign' => 'id_persona'));

        $this->hasOne('EntidadEducativa', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasOne('Tipo', array(
             'local' => 'id_tipo_perfil',
             'foreign' => 'id_tipo'));
    }
}