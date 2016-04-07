<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name="city";
    protected $_dependentTables = array('Application_Model_Experience','Application_Model_Hotel','Application_Model_Location');
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
        return $this->find($id)->current();//return it as object
    }


    function getCityById($city_id)
    {
        $ctid=$this->find($city_id)->toArray();//to return as array for populate
        return $ctid;
    }
    function allcity()
    {
        return $this->fetchAll()->toArray();
    }
    function addcity($citydata)
    {
        $row=$this->createRow();
        $row->name=$citydata['name'];
        $row->image_path=$citydata['image_path'];
        $row->description=$citydata['description'];
        $row->lat=$citydata['lat'];
        $row->longd=$citydata['longd'];
        $row->country_id=$citydata['country_id'];


        $row->save();

    }
    function deletecity($city_id)
    {
        $this->delete("id=$city_id");
    }
    function editcity($city)
    {
        $edited['name']=$city['name'];
        if($city['image_path']!="") {
            $edited['image_path'] = $city['image_path'];
        }
        $edited['description']=$city['description'];
        $edited['lat']=$city['lat'];
        $edited['longd']=$city['longd'];
        $edited['country_id']=$city['country_id'];



        $cid=$city['id'];

        $this->update($edited,"id=$cid");
    }
    function count()
    {
        $rows = $this->select()->from($this, 'count(*) as amt')->query()->fetchAll();
        return($rows[0]['amt']);
    }


}

