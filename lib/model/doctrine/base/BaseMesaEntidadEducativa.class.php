<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MesaEntidadEducativa', 'doctrine');

/**
 * BaseMesaEntidadEducativa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_entidad_educativa
 * @property integer $id_mesa
 * @property integer $id_tipo_jornada
 * @property timestamp $fecha_creado
 * @property Tipo $Tipo
 * @property EntidadEducativa $EntidadEducativa
 * @property Mesa $Mesa
 * @property Doctrine_Collection $Jurado
 * @property Doctrine_Collection $Jurado_3
 * @property Doctrine_Collection $Votante
 * @property Doctrine_Collection $Votante_4
 * 
 * @method integer              getIdEntidadEducativa()   Returns the current record's "id_entidad_educativa" value
 * @method integer              getIdMesa()               Returns the current record's "id_mesa" value
 * @method integer              getIdTipoJornada()        Returns the current record's "id_tipo_jornada" value
 * @method timestamp            getFechaCreado()          Returns the current record's "fecha_creado" value
 * @method Tipo                 getTipo()                 Returns the current record's "Tipo" value
 * @method EntidadEducativa     getEntidadEducativa()     Returns the current record's "EntidadEducativa" value
 * @method Mesa                 getMesa()                 Returns the current record's "Mesa" value
 * @method Doctrine_Collection  getJurado()               Returns the current record's "Jurado" collection
 * @method Doctrine_Collection  getJurado3()              Returns the current record's "Jurado_3" collection
 * @method Doctrine_Collection  getVotante()              Returns the current record's "Votante" collection
 * @method Doctrine_Collection  getVotante4()             Returns the current record's "Votante_4" collection
 * @method MesaEntidadEducativa setIdEntidadEducativa()   Sets the current record's "id_entidad_educativa" value
 * @method MesaEntidadEducativa setIdMesa()               Sets the current record's "id_mesa" value
 * @method MesaEntidadEducativa setIdTipoJornada()        Sets the current record's "id_tipo_jornada" value
 * @method MesaEntidadEducativa setFechaCreado()          Sets the current record's "fecha_creado" value
 * @method MesaEntidadEducativa setTipo()                 Sets the current record's "Tipo" value
 * @method MesaEntidadEducativa setEntidadEducativa()     Sets the current record's "EntidadEducativa" value
 * @method MesaEntidadEducativa setMesa()                 Sets the current record's "Mesa" value
 * @method MesaEntidadEducativa setJurado()               Sets the current record's "Jurado" collection
 * @method MesaEntidadEducativa setJurado3()              Sets the current record's "Jurado_3" collection
 * @method MesaEntidadEducativa setVotante()              Sets the current record's "Votante" collection
 * @method MesaEntidadEducativa setVotante4()             Sets the current record's "Votante_4" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMesaEntidadEducativa extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mesa_entidad_educativa');
        $this->hasColumn('id_entidad_educativa', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_mesa', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('id_tipo_jornada', 'integer', 8, array(
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
             'local' => 'id_tipo_jornada',
             'foreign' => 'id_tipo'));

        $this->hasOne('EntidadEducativa', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasOne('Mesa', array(
             'local' => 'id_mesa',
             'foreign' => 'id_mesa'));

        $this->hasMany('Jurado', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasMany('Jurado as Jurado_3', array(
             'local' => 'id_mesa',
             'foreign' => 'id_mesa'));

        $this->hasMany('Votante', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasMany('Votante as Votante_4', array(
             'local' => 'id_mesa',
             'foreign' => 'id_mesa'));
    }
}