<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        // action body
        $model = new Application_Model_Country();
        
        $countries = $model->findCountries();
        
        foreach($countries as $key=>$value)
        {
            $country[$key]['id']=$value->id;
            $country[$key]['name']=$value->name;
            $country[$key]['image_path']=$value->image_path;
            $country[$key]['rate']=$value->rate;
        }
        
        $this->view->countries = $country;
        
        $model = new Application_Model_City();
        
        $cities = $model->findCities();
        
        foreach($cities as $key=>$value)
        {
            $city[$key]['id']=$value->id;
            $city[$key]['name']=$value->name;
            $city[$key]['image_path']=$value->image_path;
            $city[$key]['rate']=$value->rate;
        }
        
        $this->view->cities = $city;
    }

    public function cityAction()
    {
        $city_model=new Application_Model_City();
        $id=$this->_request->getParam("id");
        $page=$this->_request->getParam("page");
        if(!$id){
            $id=2;
        }
        $city=$city_model->getCity($id);
        $this->view->city=$city;
       $exps= $city->findDependentRowset('Application_Model_Experience');
        $this->view->exps=$exps;
        $hotels= $city->findDependentRowset('Application_Model_Hotel');
        $this->view->hotels=$hotels;
        $hotelform=new Application_Form_Hotel();
        $this->view->hotel_form=$hotelform;
        $locations=$city->findDependentRowset('Application_Model_Location');
        $this->view->locations=$locations;
    }

    public function experAction()
    {
        $expe_model=new Application_Model_Experience();
        $id=$this->_request->getParam("id");
        $page=$this->_request->getParam("page");
        if(!$page){
            $page=1;
        }if(!$id){
        $id=2;
        }
        $exps=$expe_model->getCityExper($id);
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($exps->toArray()));
        $paginator->setItemCountPerPage(1);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator=$paginator;
        $this->view->city_id=$id;

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
        $city=[];
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

    public function bookhotelAction()
    {

    }


}







