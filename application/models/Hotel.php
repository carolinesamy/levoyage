<?php

class Application_Model_Hotel extends Zend_Db_Table_Abstract
{
    protected $_name="hotel";
    protected $_referenceMap=array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));
    function listCityHotels($city_id){
        return $this->fetchAll("city_id=$city_id");
    }

}

