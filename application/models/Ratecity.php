<?php

class Application_Model_Ratecity extends  Zend_Db_Table_Abstract
{
    protected $_name="rate_city";

function updateRate($city_id,$user_id,$newRate){
    $query = $this->select();
    $query->where("user_id=$user_id and city_id=$city_id");
    $old_rate= $this->fetchRow($query);
if($old_rate){
    $this->update(array('rate'=>$newRate),"city_id=$city_id and user_id=$user_id");

}else{
    $row=$this->createRow(array('city_id'=>$city_id,'user_id'=>$user_id,'rate'=>$newRate));
    $row->save();
}
    $query = $this->select();
    $query->where( "city_id=$city_id");
$result=$this->fetchAll($query);
    $total_rate=0;
foreach($result as $row){
    $total_rate+=$row->rate;
}
$city_model=new Application_Model_City();
    $city_model->update_rate($city_id,$total_rate);
}


}

