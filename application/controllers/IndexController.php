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

    public function getcountryAction()
    {
        // action body
        $city= new Application_Model_City();
        $country=$city->get_country(3);
        $this->view->ncountry=$country;

    }

    public function getcitiesAction()
    {
        // action body
        $countryid=$this->_request->getParam("conid");
        $country=new Application_Model_Country();
        $cities=$country->findCities($countryid);
        foreach($cities as $key=>$value)
        {
            $city[$key]['id']=$value->id;
            $city[$key]['name']=$value->name;
            $city[$key]['image']=$value->image_path;
            $city[$key]['rate']=$value->rate;
        }
        $this->view->cities=$city;
        //*********find country name***************

        $countrydata=$country->findConid($countryid);
        $this->view->countrydata=$countrydata;


        //$this->view->country=$country;
        //$this->view->cities=$cities;
    }










}



