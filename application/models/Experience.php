<?php

class Application_Model_Experience extends Zend_Db_Table_Abstract
{
    protected $_name="experience";
    protected $_dependentTable = array('Comment');
    protected $_referenceMap=array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ),
        'user'=>array(
            'columns'=>array('user_id'),
            'refTableClass'=>'Application_Model_User',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'
        ));
    function getCityExper($city_id){

        $query = $this->select();

        $query->where('city_id = ?', $city_id);
        // $query->order($order);

        return $this->fetchAll($query);

    }

}

