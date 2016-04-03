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
        $comments=$exps->getRow($page-1)->findDependentRowset('Application_Model_Comment');
        $this->comments=$comments;

    }


}





