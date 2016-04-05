showdf<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function allcountryAction()
    {
        // action body
        $country=new Application_Model_Country();
        $con=$country->allcountry();

        $this->view->count=$con;

    }

    public function deletecountryAction()
    {
        // action body
        $countryid=$this->_request->getParam("conid");
        $country=new Application_Model_Country();

        $country->deletecountry( $countryid);
        $this->redirect("/admin/allcountry");
    }

    public function addcountryAction()
    {
        // action body
        $form =new Application_Form_Addcounrty();
        $country=new Application_Model_Country();
        $this->view->addform=$form;
        $req=$this->getRequest();

        if($req->isPost()) {
            if ($form->isValid($req->getPost()))//hna pcheck 3ala l form in el data valid
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename', "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg" ,
                        'overwrite' => true));
                $upload->receive();
                $_POST['image_path'] =  $_POST['name'] . ".jpg";
                $country->addcountry($_POST);
                $this->redirect('/admin/allcountry');
            }
        }
    
    }

    public function editAction()
    {
        $form =new Application_Form_Addcounrty();
        $country=new Application_Model_Country();
        //$editcountry_form=new Application_Form_Addcountry();
        //$country_obj=new Application_Model_Country();
        $country_id=$this->_request->getParam('conid');
        $countryById=$country->getCountryById($country_id);
        $form->populate($countryById[0]);
        $this->view->editcountry=$form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name=$_FILES['image_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/levoyage/public/images/" . $name ,
                            'overwrite' => true));

                    $_POST['image_path'] =   $name;
                }

                else{
                    $_POST['image_path']="";
                }

                $upload->receive();

                $country->editCountry($_POST);
                $this->redirect('/admin/allcountry');
            }
        }




    }

    public function deletecityAction()
    {
        // action body
        $cityid=$this->_request->getParam("ctid");
        $city=new Application_Model_City();

        $city->deletecity($cityid);
        $this->redirect("/admin/allcity");
    }

    public function editcityAction()
    {
        // action body

        $form =new Application_Form_Addcity();
        $city=new Application_Model_City();
        $city_id=$this->_request->getParam('ctid');
        $cityById=$city->getCityById($city_id);
        $form->populate($cityById[0]);
        $this->view->editcity=$form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name=$_FILES['image_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/levoyage/public/images/" . $name ,
                            'overwrite' => true));

                    $_POST['image_path'] =   $name;
                }

                else{
                    $_POST['image_path']="";
                }

                $upload->receive();

                $city->editcity($_POST);
                $this->redirect('/admin/allcity');
            }
        }
    }

    public function addcityAction()
    {
        // action body

        $form =new Application_Form_Addcity();
        $city=new Application_Model_City();
        $this->view->addform=$form;
        $req=$this->getRequest();

        if($req->isPost()) {
            if ($form->isValid($req->getPost()))//hna pcheck 3ala l form in el data valid
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename', "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg" ,
                        'overwrite' => true));
                $upload->receive();
                $_POST['image_path'] =  $_POST['name'] . ".jpg";
                $city->addcity($_POST);
                $this->redirect('/admin/allcity');
            }
        }
    }

    public function allcityAction()
    {
        // action body
        $city=new Application_Model_City();
        $c=$city->allcity();

        $this->view->city=$c;
    }


}

















