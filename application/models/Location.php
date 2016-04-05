<?php

class Application_Model_Location extends Zend_Db_Table_Abstract
{
    protected $_name="location";


    protected $_referenceMap=array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));

    function allloc()
    {
        return $this->fetchAll()->toArray();
    }
    function deleteloc($loc_id)
    {
        $this->delete("id=$loc_id");
    }

}

