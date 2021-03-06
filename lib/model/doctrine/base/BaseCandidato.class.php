<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Candidato', 'doctrine');

/**
 * BaseCandidato
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_candidato
 * @property integer $no
 * @property integer $foto
 * @property integer $votos
 * @property integer $id_tipo_eleccion
 * @property integer $id_candidato_representa
 * @property timestamp $fecha_creado
 * @property Doctrine_Collection $Candidato
 * @property Votante $Votante
 * @property ArchivosEntidadEducativa $ArchivosEntidadEducativa
 * @property Tipo $Tipo
 * 
 * @method integer                  getIdCandidato()              Returns the current record's "id_candidato" value
 * @method integer                  getNo()                       Returns the current record's "no" value
 * @method integer                  getFoto()                     Returns the current record's "foto" value
 * @method integer                  getVotos()                    Returns the current record's "votos" value
 * @method integer                  getIdTipoEleccion()           Returns the current record's "id_tipo_eleccion" value
 * @method integer                  getIdCandidatoRepresenta()    Returns the current record's "id_candidato_representa" value
 * @method timestamp                getFechaCreado()              Returns the current record's "fecha_creado" value
 * @method Doctrine_Collection      getCandidato()                Returns the current record's "Candidato" collection
 * @method Votante                  getVotante()                  Returns the current record's "Votante" value
 * @method ArchivosEntidadEducativa getArchivosEntidadEducativa() Returns the current record's "ArchivosEntidadEducativa" value
 * @method Tipo                     getTipo()                     Returns the current record's "Tipo" value
 * @method Candidato                setIdCandidato()              Sets the current record's "id_candidato" value
 * @method Candidato                setNo()                       Sets the current record's "no" value
 * @method Candidato                setFoto()                     Sets the current record's "foto" value
 * @method Candidato                setVotos()                    Sets the current record's "votos" value
 * @method Candidato                setIdTipoEleccion()           Sets the current record's "id_tipo_eleccion" value
 * @method Candidato                setIdCandidatoRepresenta()    Sets the current record's "id_candidato_representa" value
 * @method Candidato                setFechaCreado()              Sets the current record's "fecha_creado" value
 * @method Candidato                setCandidato()                Sets the current record's "Candidato" collection
 * @method Candidato                setVotante()                  Sets the current record's "Votante" value
 * @method Candidato                setArchivosEntidadEducativa() Sets the current record's "ArchivosEntidadEducativa" value
 * @method Candidato                setTipo()                     Sets the current record's "Tipo" value
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCandidato extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('candidato');
        $this->hasColumn('id_candidato', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('no', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('foto', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('votos', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_tipo_eleccion', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_candidato_representa', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => false,
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
        $this->hasMany('Candidato', array(
             'local' => 'id_candidato',
             'foreign' => 'id_candidato_representa'));

        $this->hasOne('Votante', array(
             'local' => 'id_candidato',
             'foreign' => 'id_votante'));

        $this->hasOne('ArchivosEntidadEducativa', array(
             'local' => 'foto',
             'foreign' => 'id_archivo'));

        $this->hasOne('Tipo', array(
             'local' => 'id_tipo_eleccion',
             'foreign' => 'id_tipo'));
    }
}