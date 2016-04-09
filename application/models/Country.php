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
        $row->lat=$countrydata['lat'];
        $row->longd=$countrydata['longd'];
        $row->save();

    }
    function editCountry($country)
    {
        $edited['name']=$country['name'];
        if($country['image_path']!="") {
            $edited['image_path'] = $country['image_path'];
        }
        $edited['lat']=$country['lat'];
        $edited['longd']=$country['longd'];
        $cid=$country['id'];
        $this->update($edited,"id=$cid");
    }

    function count()
    {
        $rows = $this->select()->from($this, 'count(*) as amt')->query()->fetchAll();
        return($rows[0]['amt']);
    }
    function update_rate($country_id,$total_rate){
        $this->update(array('rate'=>$total_rate),"id=$country_id");
    }
}

