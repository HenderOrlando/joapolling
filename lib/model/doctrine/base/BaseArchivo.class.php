<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Archivo', 'doctrine');

/**
 * BaseArchivo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_archivo
 * @property string $nombre
 * @property string $src
 * @property string $extension
 * @property Doctrine_Collection $ArchivosEntidadEducativa
 * 
 * @method integer             getIdArchivo()                Returns the current record's "id_archivo" value
 * @method string              getNombre()                   Returns the current record's "nombre" value
 * @method string              getSrc()                      Returns the current record's "src" value
 * @method string              getExtension()                Returns the current record's "extension" value
 * @method Doctrine_Collection getArchivosEntidadEducativa() Returns the current record's "ArchivosEntidadEducativa" collection
 * @method Archivo             setIdArchivo()                Sets the current record's "id_archivo" value
 * @method Archivo             setNombre()                   Sets the current record's "nombre" value
 * @method Archivo             setSrc()                      Sets the current record's "src" value
 * @method Archivo             setExtension()                Sets the current record's "extension" value
 * @method Archivo             setArchivosEntidadEducativa() Sets the current record's "ArchivosEntidadEducativa" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseArchivo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('archivo');
        $this->hasColumn('id_archivo', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('nombre', 'string', 30, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 30,
             ));
        $this->hasColumn('src', 'string', 120, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 120,
             ));
        $this->hasColumn('extension', 'string', 5, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 5,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ArchivosEntidadEducativa', array(
             'local' => 'id_archivo',
             'foreign' => 'id_archivo'));
    }
}