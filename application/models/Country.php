<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
    protected $_name="country";
    //to add parent --dependent tables on it
    protected $_dependentTables=array('Application_Model_City');

    function findCities($country_id)
    {
        $countryrow=$this->find($country_id)->current();
        $cities=$countryrow->findDependentRowset('Application_Model_City');
        return $cities;
    }

    function findConid($country_id)
    {
        $couid=$this->find($country_id)->current();
        return $couid;
    }
    function getCountryById($country_id)
    {
        $conid=$this->find($country_id)->toArray();
        return $conid;
    }

    function deletecountry($country_id)
    {
        $this->delete("id=$country_id");
    }

    function allcountry()
    {
        $couid=$this->fetchAll()->toArray();
        return $couid;
    }
    function addcountry($countrydata)
    {
        $row=$this->createRow();
        $row->name=$countrydata['name'];
        $row->image_path=$countrydata['image_path'];
        $row->save();

    }


}

