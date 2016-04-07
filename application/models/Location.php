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
    function addloc($locdata)
    {
        $row=$this->createRow();
        $row->name=$locdata['name'];
        $row->image_path=$locdata['image_path'];
        $row->description=$locdata['description'];
        $row->city_id=$locdata['city_id'];
        $row->save();

    }
    function getlocById($loc_id)
    {
        $locid=$this->find($loc_id)->toArray();//to return as array for populate
        return $locid;
    }
    function editloc($loc)
    {
        $edited['name']=$loc['name'];
        if($loc['image_path']!="") {
            $edited['image_path'] = $loc['image_path'];
        }
        $edited['description']=$loc['description'];
        $edited['city_id']=$loc['city_id'];



        $loc_id=$loc['id'];

        $this->update($edited,"id=$loc_id");
    }
    function count()
    {
        $rows = $this->select()->from($this, 'count(*) as amt')->query()->fetchAll();
        return($rows[0]['amt']);
    }

}

