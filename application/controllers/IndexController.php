<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function cityAction()
    {
        $city_model=new Application_Model_City();
        $id=$this->_request->getParam("id");
        $city=$city_model->getCity($id);
        $this->view->city=$city;
    }


}



