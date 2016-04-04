<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization=Zend_Auth::getInstance();
        $fbsession=new Zend_Session_Namespace('facebook');
        $twsession=new Zend_Session_Namespace('twitter');
        if (!$authorization->hasIdentity() &&!isset($fbsession->username) &&!isset($twsession->username))
          {
            if ($this->_request->getActionName() != 'login' && $this->_request->getActionName() != 'add' && $this->_request->getActionName() != 'fbauth' && $this->_request->getActionName() != 'twauth') {
                 $this->redirect("user/login");
              }
          }

    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        $authorization=Zend_Auth::getInstance();
        $fbsession=new Zend_Session_Namespace('facebook');
        $twsession=new Zend_Session_Namespace('twitter');
        if ($authorization->hasIdentity() || isset($fbsession->username)  || isset($twsession->username))
          {
            $this->redirect("/index");
          }
        // action body
		$form = new Application_Form_Register();
		$request = $this->getRequest();
		if($request->isPost()){
			if($form->isValid($request->getPost())){
				$user_model = new Application_Model_User();
				$user_model-> adduser($request->getParams());
                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('password');
                $db = Zend_Db_Table::getDefaultAdapter( );
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, "user", "email",
                "password");
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                $result = $authAdapter->authenticate();
                $auth = Zend_Auth::getInstance( );
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('email','id',
                'username')));
				$this->redirect('/index');
			}
		}
		$this->view->register_form = $form;
    }

    public function loginAction()
    {
        // action body
         $login_form = new Application_Form_Login( );
         $this->view->login_form = $login_form;
         if ($this->_request->isPost()) {
             if ($login_form->isValid($this->_request->getPost( ))) {
             // after check for validation get email and password to start auth
                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('password');

                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter( );
                //create the auth adapter
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, "user", "email",
                "password");
                //set the email and password
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);

                $result = $authAdapter->authenticate();
                if ($result->isValid( )) {

                //if the user is valid register his info in session
                $auth = Zend_Auth::getInstance( );//if the user is valid register his info in session
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                // write in session email & id & first_name
                $storage->write($authAdapter->getResultRowObject(array('email','id',
                'username')));
                // redirect to root index/index
                return $this->redirect('/index');
            } else {
                     // if user is not valid send error message to view
                     $this->view->error_message = "Invalid email or Password!";
                    }
                }

            }

            $fb = new Facebook\Facebook([
             'app_id' => '938451796268816', // Replace {app-id} with your app id
             'app_secret' => '75080231ab12cfd9df4b2062d34538f4',
             'default_graph_version' => 'v2.2',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .
            $this->view->baseUrl() . '/user/fbauth');
            $this->view->facebook_url = $loginUrl;
            $this->view->twitterUrl = '/user/twauth';
    }

    public function fbauthAction()
    {
             // action body
            //instance from facebook
            $fb = new Facebook\Facebook([
           'app_id' => '938451796268816', // Replace {app-id} with your app id
           'app_secret' => '75080231ab12cfd9df4b2062d34538f4',
            'default_graph_version' => 'v2.2',
            ]);
            // use helper method of facebook for login
            $helper = $fb->getRedirectLoginHelper();
            try {
            $accessToken = $helper->getAccessToken();
            }
            catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error (headers link)
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
            }
            catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
            }
            // handle access toaken & print full error message
            if (!isset($accessToken)) {
            if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() ."\n";
            }
            else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
                }
            Exit;
            }
            // Logged in
            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb-> getOAuth2Client ();
            //check if access token expired
            if (!$accessToken-> isLongLived ()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
            // try to get another access token
            $accessToken = $oAuth2Client-> getLongLivedAccessToken ($accessToken);
            }
            catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo "<p>Error getting long-lived access token: " . $helper->getMessage () . "</p>\n\n";
            Exit;
            }
            }
            //Sets the default fallback access token so we don't have to pass it to each request
            $fb->setDefaultAccessToken($accessToken);
            try {
            $response = $fb->get('/me');
            $userNode = $response->getGraphUser();
            }
            catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            Exit;
            }
            catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            Exit;
            }
            $fpsession = new Zend_Session_Namespace('facebook');
            // write in session email & id & first_name
            $fpsession->username = $userNode->getName();
            $this->redirect();

    }

    public function fblogoutAction()
    {
        // action body
         Zend_Session::namespaceUnset('facebook');
         $this->redirect("/user/login");       
    }

    public function logoutAction()
    {
        // action body
        Zend_Session::namespaceUnset('Zend_Auth');
        $this->redirect("/user/login");      

    }

    public function twauthAction()
    {
        // $settings = array(
		// 'oauth_access_token' => "715304296280100865-2E8xbUznLTPrwoqXkRUaSPR7MYfKwS2",
		// 'oauth_access_token_secret' => "vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU",
		// 'consumer_key' => "WY7NpcSMyrEpOMhXvdMixoxqJ",
		// 'consumer_secret' => "vsrOIbN1adtWoqyhAJuFH44WBS3xrMarYtvV0RhO9hA5C"
		// );




        // require('twitteroauth.php');
        // define('CONSUMER_KEY','WY7NpcSMyrEpOMhXvdMixoxqJ');
        // define('CONSUMER_SECRET','vsrOIbN1adtWoqyhAJuFH44WBS3xrMarYtvV0RhO9hA5C');
        // define('OAUTH_CALLBACK', 'http://localhost/levoyage.com/user/twauth');


    }

    public function twlogoutAction()
    {
        // action body
         Zend_Session::namespaceUnset('twitter');
         $this->redirect("/user/login");
    }

    public function getcountryAction()
    {
        // action body
        $city= new Application_Model_City();
        $country=$city->get_country(3);
        $this->view->ncountry=$country;
    }

    public function editprofileAction()
    {
        // action body
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        $id =  $sessionRead->id;
        $form = new Application_Form_Editform ();
        $user_model = new Application_Model_User();
        $user_data = $user_model-> userDetails ($id)->current();
        $carRents=$user_data->findDependentRowset('Application_Model_RentCar');
        $this->view->cars=$carRents;
        $form->populate($user_data->toArray());
        $this->view->user_form = $form;
        $request = $this->getRequest ();
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){          
                $user_model-> updateuser ($id,$_POST);
                //the following code to update user name in layout
                $email = $this->_request->getParam('email');
                $password = $this->_request->getParam('password');
                $db = Zend_Db_Table::getDefaultAdapter( );
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, "user", "email","password");
                $authAdapter->setIdentity($email);
                $authAdapter->setCredential($password);
                $result = $authAdapter->authenticate();
                $auth = Zend_Auth::getInstance( );
                $storage = $auth->getStorage();
                $storage->write($authAdapter->getResultRowObject(array('email','id',
                'username')));
                $this->redirect();
            }
        }
    }

    public function getcitiesAction()
    {
        // action body
        $countryid=$this->_request->getParam("conid");
        $country=new Application_Model_Country();
        $cities=$country->findCities($countryid);
        foreach($cities as $key=>$value)
        {
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

    public function commAction()
    {
        // action body
    }

    public function addexperAction()
    {
        // action body
        $form = new Application_Form_Addexperience ();
        $this->view->exper_form = $form;
        $user_model = new Application_Model_Experience();
        $request = $this->getRequest ();
        $city_id = $this->_request->getParam('id');
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){
    	    $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $sessionRead = $storage->read();
            $id =  $sessionRead->id;
            $upload = new Zend_File_Transfer_Adapter_Http();
            $upload->addValidator('Size', false, 52428800, 'image');
            $upload->setDestination('../public/images');
            $files = $upload->getFileInfo();
            foreach ($files as $file => $info) {
            if ($upload->isValid($file)) {
                //save image in server
             $upload->receive($file);
             //send data to model
    	     $photo=$files['photo']['name'];
             $user_model-> addexper($id,$photo,$_POST,$city_id);
             $this->redirect("/index/city/id/$city_id");
         }
    }

    }
}


    }

    public function bookhotelAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $hotel_model=new Application_Model_Bookhotel();

        //makes disable layout
        $this->_helper->getHelper('layout')->disableLayout(true);
        if(!$rooms=($_POST['members']/4)){
            $rooms=1;
        }

        $data= array(
            'hotel_name' =>$_POST['hotel'],
            'time_from' =>$_POST['from'],
            'time_to' =>$_POST['to'],
            'user_id' =>$_POST['user_id'],
            'num_member' =>$_POST['members'],
            'num_rooms'=>$rooms
        );
        $hotel_model->addBook($data);
        echo true;
    }


}


