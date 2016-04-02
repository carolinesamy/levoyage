<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name="city";
    //
    protected $_referenceMap=array('country'=>array(
        'columns'=>array('country_id'),
        'refTableClass'=>'Application_Model_Country',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));
    public function get_country($city_id)
    {

        $cityrow=$this->find($city_id)->current();
        $countryData=$cityrow->findParentRow('Application_Model_Country');
        return $countryData;
    }


}

