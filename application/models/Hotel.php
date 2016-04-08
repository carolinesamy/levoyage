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
    function allhotel()
    {
        return $this->fetchAll()->toArray();
    }
    function deletehotel($hotelname)
    {
        $this->delete("name='$hotelname'");
    }
    function addhotel($hoteldata)
    {
        $row=$this->createRow();
        $row->name=$hoteldata['name'];
        $row->city_id=$hoteldata['city_id'];
        $row->save();

    }
    function getHotelByname($hotelname)
    {
        $hotelname=$this->find($hotelname)->toArray();//to return as array for populate
        return $hotelname;
    }

    function edithotel($hotel,$hotel_name)
    {
        $edited['name']=$hotel['name'];
        $edited['city_id']=$hotel['city_id'];
        $this->update($edited,"name='$hotel_name'");
    }
    function count()
    {
        $rows = $this->select()->from($this, 'count(*) as amt')->query()->fetchAll();
        return($rows[0]['amt']);
    }

}

