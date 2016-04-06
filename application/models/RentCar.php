<?php

class Application_Model_RentCar extends Zend_Db_Table_Abstract
{
protected $_name = 'rent_car';

protected $_referenceMap=array('user'=>array(
        'columns'=>array('user_id'),
        'refTableClass'=>'Application_Model_User',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));
    function addRentCar($data){
        $row=$this->createRow($data);
        $row->save();
    }
}

