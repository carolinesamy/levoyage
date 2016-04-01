<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name="city";
    protected $_dependentTables = array('Experience','Hotel','Location');
    protected $_referenceMap=array('country'=>array(
        'columns'=>array('country_id'),
        'refTableClass'=>'Application_Model_Country',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));

    function getCity($id)
    {
        return $this->find($id)->current();
    }

}

