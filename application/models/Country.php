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
    function findCountries()
    {
    	
    	$query = $this->select(); 
    	 $query->order('rate DESC'); 
    	 $query->limit(6);
    	 return $results = $this->fetchAll($query);

    }

}

