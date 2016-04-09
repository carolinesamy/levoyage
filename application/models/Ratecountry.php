<?php

class Application_Model_Ratecountry extends  Zend_Db_Table_Abstract
{
    protected $_name="rate_country";

    function updateRate($country_id,$user_id,$newRate){
        $query = $this->select();
        $query->where("user_id=$user_id and country_id=$country_id");
        $old_rate= $this->fetchRow($query);
        if($old_rate){
            $this->update(array('rate'=>$newRate),"country_id=$country_id and user_id=$user_id");

        }else{
            $row=$this->createRow(array('country_id'=>$country_id,'user_id'=>$user_id,'rate'=>$newRate));
            $row->save();
        }
        $query = $this->select();
        $query->where( "country_id=$country_id");
        $result=$this->fetchAll($query);
        $total_rate=0;
        foreach($result as $row){
            $total_rate+=$row->rate;
        }
        $country_model=new Application_Model_Country();
        $country_model->update_rate($country_id,$total_rate);
    }
}

