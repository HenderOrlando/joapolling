<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CursosGrado', 'doctrine');

/**
 * BaseCursosGrado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id_curso_grado
 * @property integer $id_curso
 * @property integer $id_grado
 * @property integer $id_entidad_educativa
 * @property timestamp $fecha_creado
 * @property Curso $Curso
 * @property GradoEntidadEducativa $GradoEntidadEducativa
 * @property GradoEntidadEducativa $GradoEntidadEducativa_3
 * @property Doctrine_Collection $Estudiante
 * 
 * @method integer               getIdCursoGrado()            Returns the current record's "id_curso_grado" value
 * @method integer               getIdCurso()                 Returns the current record's "id_curso" value
 * @method integer               getIdGrado()                 Returns the current record's "id_grado" value
 * @method integer               getIdEntidadEducativa()      Returns the current record's "id_entidad_educativa" value
 * @method timestamp             getFechaCreado()             Returns the current record's "fecha_creado" value
 * @method Curso                 getCurso()                   Returns the current record's "Curso" value
 * @method GradoEntidadEducativa getGradoEntidadEducativa()   Returns the current record's "GradoEntidadEducativa" value
 * @method GradoEntidadEducativa getGradoEntidadEducativa3()  Returns the current record's "GradoEntidadEducativa_3" value
 * @method Doctrine_Collection   getEstudiante()              Returns the current record's "Estudiante" collection
 * @method CursosGrado           setIdCursoGrado()            Sets the current record's "id_curso_grado" value
 * @method CursosGrado           setIdCurso()                 Sets the current record's "id_curso" value
 * @method CursosGrado           setIdGrado()                 Sets the current record's "id_grado" value
 * @method CursosGrado           setIdEntidadEducativa()      Sets the current record's "id_entidad_educativa" value
 * @method CursosGrado           setFechaCreado()             Sets the current record's "fecha_creado" value
 * @method CursosGrado           setCurso()                   Sets the current record's "Curso" value
 * @method CursosGrado           setGradoEntidadEducativa()   Sets the current record's "GradoEntidadEducativa" value
 * @method CursosGrado           setGradoEntidadEducativa3()  Sets the current record's "GradoEntidadEducativa_3" value
 * @method CursosGrado           setEstudiante()              Sets the current record's "Estudiante" collection
 * 
 * @package    sf_sandbox
 * @subpackage model
 * @author     Hender Orlando Puello Rincón
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCursosGrado extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('cursos_grado');
        $this->hasColumn('id_curso_grado', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_curso', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
             ));
        $this->hasColumn('id_grado', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => true,
             'primary' => false,
             'notnull' => true,
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
        $this->hasOne('Curso', array(
             'local' => 'id_curso',
             'foreign' => 'id_curso'));

        $this->hasOne('GradoEntidadEducativa', array(
             'local' => 'id_grado',
             'foreign' => 'id_grado'));

        $this->hasOne('GradoEntidadEducativa as GradoEntidadEducativa_3', array(
             'local' => 'id_entidad_educativa',
             'foreign' => 'id_entidad_educativa'));

        $this->hasMany('Estudiante', array(
             'local' => 'id_curso_grado',
             'foreign' => 'id_curso'));
    }
}