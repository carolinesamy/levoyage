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
        $page=$this->_request->getParam("page");
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





