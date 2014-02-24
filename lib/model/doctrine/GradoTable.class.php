<?php

/**
 * GradoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class GradoTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object GradoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Grado');
    }
    public static function getGrado($array) {
        if(is_array($array)){
            $q = GradoTable::getInstance()->createQuery();
            foreach ($array as $i => $d){
                $q->andWhere($i.' =? ',$d);
            }
            return $q->fetchOne();
        }
        else
            return false;
    }
}