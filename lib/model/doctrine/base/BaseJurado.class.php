<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Jurado', 'doctrine');

/**
 * BaseJurado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_jurado
 * @property integer $id_entidad_educativa
 * @property integer $id_mesa
 * @property integer $id_tipo_jurado
 * @property timestamp $fecha_creado
 * @property Tipo $Tipo
 * @property MesaEntidadEducativa $MesaEntidadEducativa
 * @property MesaEntidadEducativa $MesaEntidadEducativa_3
 * @property Persona $Persona
 * 
 * @method integer              getIdJurado()               Returns the current record's "id_jurado" value
 * @method integer              getIdEntidadEducativa()     Returns the current record's "id_entidad_educativa" value
 * @method integer              getIdMesa()                 Returns the current record's "id_mesa" value
 * @method integer              getIdTipoJurado()           Returns the current record's "id_tipo_jurado" value
 * @method timestamp            getFechaCreado()            Returns the current record's "fecha_creado" value
 * @method Tipo                 getTipo()                   Returns the current record's "Tipo" value
 * @method MesaEntidadEducativa getMesaEntidadEducativa()   Returns the current record's "MesaEntidadEducativa" value
 * @method MesaEntidadEducativa getMesaEntidadEducativa3()  Returns the current record's "MesaEntidadEducativa_3" value
 * @method Persona              getPersona()                Returns the current record's "Persona" value
 * @method Jurado               setIdJurado()               Sets the current record's "id_jurado" value
 * @method Jurado               setIdEntidadEducativa()     Sets the current record's "id_entidad_educativa" value
 * @method Jurado               setIdMesa()                 Sets the current record's "id_mesa" value
 * @method Jurado               setIdTipoJurado()           Sets the current record's "id_tipo_jurado" value
 * @method Jurado               setFechaCreado()            Sets the current record's "fecha_creado" value
 * @method Jurado               setTipo()                   Sets the current record's "Tipo" value
 * @method Jurado               setMesaEntidadEducativa()   Sets the current record's "MesaEntidadEducativa" value
 * @method Jurado               setMesaEntidadEducativa3()  Sets the current record's "MesaEntidadEducativa_3" value
 * @method Jurado               setPersona()                Sets the current record's "Persona" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJurado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jurado');
        $this->hasColumn('id_jurado', 'integer', 8, array(
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
        $this->hasColumn('id_mesa', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_tipo_jurado', 'integer', 8, array(
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
        $this->hasOne('Tipo', array(
             'local' => 'id_tipo_jurado',
             'foreign' => 'id_tipo'));

        $this->hasOne('MesaEntidadEducativa', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasOne('MesaEntidadEducativa as MesaEntidadEducativa_3', array(
             'local' => 'id_mesa',
             'foreign' => 'id_mesa'));

        $this->hasOne('Persona', array(
             'local' => 'id_jurado',
             'foreign' => 'id_persona'));
    }
}