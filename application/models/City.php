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
    public function get_country($city_id)
    {

        $cityrow=$this->find($city_id)->current();
        $countryData=$cityrow->findParentRow('Application_Model_Country');
        return $countryData;
    }

    function getCity($id)
    {
        return $this->find($id)->current();
    }
    function allcity()
    {
        return $this->fetchAll()->toArray();
    }
    function addcity($citydata)
    {
        $row=$this->createRow();
        $row->id=$citydata['id'];
        $row->name=$citydata['name'];
        $row->image_path=$citydata['image_path'];
        $row->description=$citydata['description'];
        $row->save();

    }
    function deletecity($city_id)
    {
        $this->delete("id=$city_id");
    }

}

