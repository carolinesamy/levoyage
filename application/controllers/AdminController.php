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
        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['image_path']['name'];

                if ($name != "") {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/levoyage/public/images/" . $name,
                            'overwrite' => true));

                    $_POST['image_path'] = $name;
                } else {
                    $_POST['image_path'] = "";
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
                    array('target' => "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg",
                        'overwrite' => true));
                $upload->receive();
                $_POST['image_path'] = $_POST['name'] . ".jpg";
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

    public function allhotelAction()
    {
        // action body
        $city=new Application_Model_Hotel();
        $c=$city->allhotel();

        $this->view->hotel=$c;
    }

    public function addhotelAction()
    {
        // action body

        $form =new Application_Form_Addhotel();
        $hotel=new Application_Model_Hotel();
        $this->view->addform=$form;
        $req=$this->getRequest();

        if($req->isPost()) {
            if ($form->isValid($req->getPost()))//hna pcheck 3ala l form in el data valid
            {

                $hotel->addhotel($_POST);
                $this->redirect('/admin/allhotel');
            }
        }

    }

    public function edithotelAction()
    {
        // action body

        $form =new Application_Form_Addhotel();
        $hotel=new Application_Model_Hotel();
        $hotel_name=$this->_request->getParam('hid');
        $hotelByName=$hotel->getHotelByname($hotel_name);
        $form->populate($hotelByName[0]);
        $this->view->edithotel=$form;

        $request=$this->getRequest();
        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $hotel->edithotel($_POST,$hotel_name);
                $this->redirect('/admin/allhotel');
            }
        }
        
    }

    public function deletehotelAction()
    {
        // action body
        $hotelname=$this->_request->getParam("hid");
        $hotel=new Application_Model_Hotel();

        $hotel->deletehotel($hotelname);
        $this->redirect("/admin/allhotel");
    }

    public function addlocAction()
    {
        // action body
        $form =new Application_Form_Addlocation();
        $city=new Application_Model_Location();
        $this->view->addform=$form;
        $req=$this->getRequest();

        if($req->isPost()) {
            if ($form->isValid($req->getPost()))//hna pcheck 3ala l form in el data valid
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                //$upload->addFilter('Rename', "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg");
                $upload->addFilter('Rename',
                    array('target' => "/var/www/html/levoyage/public/images/" . $_POST['name'] . ".jpg",
                        'overwrite' => true));
                $upload->receive();
                $_POST['image_path'] = $_POST['name'] . ".jpg";
                $city->addloc($_POST);
                $this->redirect('/admin/allloc');
            }
        }

    }

    public function alllocAction()
    {
        // action body
        $loc=new Application_Model_Location();
        $c=$loc->allloc();
        $count=$loc->count();
        $this->view->loc=$count;

        $this->view->location=$c;
    }

    public function editlocAction()
    {
        // action body
        $form =new Application_Form_Addlocation();
        $loc=new Application_Model_Location();
        $loc_id=$this->_request->getParam('locid');
        $locById=$loc->getlocById($loc_id);
        $form->populate($locById[0]);
        $this->view->editloc=$form;

        $request=$this->getRequest();
        if($request->isPost())
        {
            if ($form->isValid($request->getPost()))
            {
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name = $_FILES['image_path']['name'];

                if ($name != "")
                {
                    $upload->addFilter('Rename',
                        array('target' => "/var/www/html/levoyage/public/images/" . $name,
                            'overwrite' => true));

                    $_POST['image_path'] = $name;
                }
                else
                {
                    $_POST['image_path'] = "";
                }

                $upload->receive();

                $loc->editloc($_POST);
                $this->redirect('/admin/allloc');
            }
        }
        
    }

    public function deletelocAction()
    {
        $locid=$this->_request->getParam("locid");
        $loc=new Application_Model_Location();

        $loc->deleteloc($locid);
        $this->redirect("/admin/allloc");
    }

    public function deleteuserAction()
    {
        // action body
        $userid=$this->_request->getParam("uid");
        $user=new Application_Model_User();

        $user->deleteuser($userid);
        $this->redirect("/admin/alluser");

    }

    public function blockuserAction()
    {
        // action body
        $users=new Application_Model_User();
        $user=$this->_request->getParam("uid");
        $users->blockuser($user);
        $this->redirect("/admin/alluser");

    }

    public function alluserAction()
    {
        // action body
        $users=new Application_Model_User();
        $user=$users->alluser();

        $this->view->user=$user;

    }

    public function unblockuserAction()
    {
        // action body
        $users=new Application_Model_User();
        $user=$this->_request->getParam("uid");
        $users->unblockuser($user);
        $this->redirect("/admin/alluser");

    }

    public function setadminAction()
    {
        // action body
        $users=new Application_Model_User();
        $user=$this->_request->getParam("uid");
        $users->setadmin($user);
        $this->redirect("/admin/alluser");
    }




}


























