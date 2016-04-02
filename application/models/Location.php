<?php

class Application_Model_Location
{
    protected $_name="location";


    protected $_referenceMap=array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ));

}

