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

        if($req->isPost()){
            if ($form->isValid($req->getPost()))//hna pcheck 3ala l form in el data valid
            {
                $upload=new Zend_File_Transfer_Adapter_Http();
                $upload->addFilter('Rename',"/var/www/html/levoyage/public/images/".$_POST['name'].".jpg");
                $upload->receive();
                $_POST['image_path']="/images/".$_POST['name'].".jpg";
                $country->addcountry($_POST);
                $this->redirect('/admin/allcountry');
            }
    }
    }


}







