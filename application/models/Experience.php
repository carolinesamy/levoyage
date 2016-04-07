<?php

class Application_Model_Experience extends Zend_Db_Table_Abstract
{
    protected $_name="experience";
    protected $_dependentTable = array('Comment');
    protected $_referenceMap=array('city'=>array(
        'columns'=>array('city_id'),
        'refTableClass'=>'Application_Model_City',
        'refColumns'=>array('id'),
        'onDelete'=>'cascade'
    ),
        'user'=>array(
            'columns'=>array('user_id'),
            'refTableClass'=>'Application_Model_User',
            'refColumns'=>array('id'),
            'onDelete'=>'cascade'
        ));
    function getCityExper($city_id){

        $query = $this->select();

        $query->where('city_id = ?', $city_id);
        // $query->order($order);

        return $this->fetchAll($query);

    }



        function addexper($id,$photo,$experData,$city_id)
          {
            $row = $this->createRow();
            $row->content = $experData['content'];
            $row->title = $experData['title'];
            $row->city_id =$city_id;
            $row->user_id = $id;
            $row->image_path =$photo;
            $row->save();   
          }

        function experDetails($id)
         {
       
            return $this->find($id);
          }

          function updateexper($post_id,$experData){
            $experToBeUpdated['photo']=$experData['photo'];
            $experToBeUpdated['title']=$experData['title'];
            $experToBeUpdated['content']=$experData['content'];
            $this->update($experToBeUpdated,"id=$post_id");
          }
}

