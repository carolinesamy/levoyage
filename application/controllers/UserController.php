<?php

  use Abraham\TwitterOAuth\TwitterOAuth;

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization=Zend_Auth::getInstance();
        $fbsession=new Zend_Session_Namespace('facebook');
        $twsession=new Zend_Session_Namespace('twitter');
        $gogsession=new Zend_Session_Namespace('google');
        if (!$authorization->hasIdentity() &&!isset($fbsession->username) &&!isset($twsession->username) &&!isset($gogsession->username))
          {
            if ($this->_request->getActionName() != 'login' && $this->_request->getActionName() != 'add' && $this->_request->getActionName() != 'fbauth' && $this->_request->getActionName() != 'twauth' && $this->_request->getActionName() != 'googleauth') {
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
        $gogsession=new Zend_Session_Namespace('google');
        //this part of code to pane logined user from registring 
        if ($authorization->hasIdentity() || isset($fbsession->username)  || isset($twsession->username)|| isset($gogsession->username))
          {
            $this->redirect("/index");
          }
		$form = new Application_Form_Register();
        $this->view->register_form = $form;
		$request = $this->getRequest();
		if($request->isPost()){
			if($form->isValid($request->getPost())){
				$user_model = new Application_Model_User();
				$user_model-> adduser($request->getParams());
                //this part of code to login user in automatically after registring
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
                'username','is_active','is_admin')));
				$this->redirect('/index');
			}
		}
    }

    public function loginAction()
    {
        require_once  'google-api-php-client/src/Google/autoload.php';
        require_once "twitteroauth-master/autoload.php";        // action body
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
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                // write in session email & id & first_name
                $storage->write($authAdapter->getResultRowObject(array('email','id',
                'username','is_active','is_admin')));
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

            ///////////////////////////////////////////////////
            $connection = new TwitterOAuth('WY7NpcSMyrEpOMhXvdMixoxqJ','vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU');
            $token = $connection->oauth('oauth/request_token', array('oauth_callback' => 'http://levoyage.com/user/twauth'));
            $_SESSION['oauth_token'] = $token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];

            $url = $connection->url('oauth/authorize', array('oauth_token' => $token['oauth_token']));
            $this->view->twitterUrl =$url;
            ////////////////////////////////////////////////

            $client_id = '583487569624-n001lnrj9a18iugmih6rhd9m6ma5pjpb.apps.googleusercontent.com';
            $client_secret = 'Q8kgnUl01apPxPhPyEIlYQw5';
            $redirect_uri = 'http://levoyage.com/user/googleauth';
            $client = new Google_Client();
            $client->setClientId($client_id);
            $client->setClientSecret($client_secret);
            $client->setRedirectUri($redirect_uri);
            $client->addScope("profile");
            $client->addScope(" https://www.googleapis.com/auth/plus.profile.emails.read");   
            $authUrl = $client->createAuthUrl();
            $this->view->google_url = $authUrl;


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
            $fbsession->username = $userNode->getName();
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
  //       $settings = array('key' => "WY7NpcSMyrEpOMhXvdMixoxqJ",
		// 'secret' => "vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU"
		// );
        require_once "twitteroauth-master/autoload.php";
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

        if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            // Abort! Something is wrong.
        }

        $connection = new TwitterOAuth('WY7NpcSMyrEpOMhXvdMixoxqJ', 'vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU', $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);



        $connection = new TwitterOAuth('WY7NpcSMyrEpOMhXvdMixoxqJ', 'vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU', $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $content = $connection->get("account/verify_credentials");
        $id=$content->id;
        $name=$content->screen_name;
        $twsession=new Zend_Session_Namespace('twitter');
        $twsession->username = $name;
        $twsession->id = $id;
        $this->redirect();
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
        $hotelRes=$user_data->findDependentRowset('Application_Model_Bookhotel');
        $this->view->cars=$carRents;
        $this->view->hotels=$hotelRes;
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
                foreach ($files as $file => $info) 
                {
                    if ($upload->isValid($file)) {
                            //save image in server
                         $upload->receive($file);
                         //send data to model
                	     $photo=$files['photo']['name'];
                         $user_model-> addexper($id,$photo,$_POST,$city_id);
                         $this->redirect("/index/exper/id/$city_id?/page=1");
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

    public function mailAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout(true);
        $request = $this->getRequest ();
        if($request->isPost() ){
            $message = $this->_request->getParam('message');
            $subject = $this->_request->getParam('subject');
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $user=$storage->read();
            $email = new Zend_Mail();
            $email->setFrom('opensource.iti36@gmail.com', 'Le Voyage');
            $email->addTo($user->email, 'Le Voyage Client');
            $email->setSubject($subject);
            $email->setBodyText($message);
            $email->send();
        }
    }

    public function googleauthAction()
    {
    
  require_once  'google-api-php-client/src/Google/autoload.php';


        $client_id = '583487569624-n001lnrj9a18iugmih6rhd9m6ma5pjpb.apps.googleusercontent.com';
         $client_secret = 'Q8kgnUl01apPxPhPyEIlYQw5';
         $redirect_uri = 'http://levoyage.com/user/googleauth';
        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("profile");
        $client->addScope("https://www.googleapis.com/auth/plus.profile.emails.read");

        $authUrl = $client->createAuthUrl();

        if (isset($_GET['code'])) {

          $client->authenticate($_GET['code']);
          $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
          //echo $_SESSION['access_token'];exit();
          $service=new Google_Service_Plus($client);

          $data=$service->people->get('me');
          $mail=$data['modelData']['emails'][0]['value'];
          $name=$data['modelData']['name']['givenName'];
          $id=$data['id'];
          $gogsession = new Zend_Session_Namespace('google');
            // write in session email & id & first_name
            $gogsession->username = $name;
            $gogsession->email = $email;
            $gogsession->id = $id;
            $this->redirect();


  }  else{
    $this->redirect("/index");
  }

    }
    //this function is to update experience
    public function bactoctyAction()
    {
        $form = new Application_Form_Addexperience ();
        $this->view->exper_form = $form;
        $user_model = new Application_Model_Experience();
        $request = $this->getRequest ();
        $post_id = $this->_request->getParam('pid');
        $city_id = $this->_request->getParam('cid');
        $user_data = $user_model-> experDetails($post_id)->toArray();
        $form->populate($user_data[0]);
        $this->view->exper_form = $form;
        $request = $this->getRequest ();
        if($request-> isPost()){
            if($form-> isValid($request-> getPost())){ 
                $upload = new Zend_File_Transfer_Adapter_Http();
                $name= $_FILES['photo']['name'];

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

                $user_model-> updateexper ($post_id,$_POST);
                $this->redirect("/index/exper/id/$city_id?/page=1");
            }
       }

    }

    public function rentcarAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $car_model=new Application_Model_RentCar();
        //makes disable layout
        $this->_helper->getHelper('layout')->disableLayout(true);
        $request = $this->getRequest ();
        if($request->isPost() ){
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $user=$storage->read();
        $data= array(
            'user_id' =>$_REQUEST['user_id'],
            'from_city' =>$_REQUEST['from_city'],
            'to_city' =>$_REQUEST['to_city'],
            'pick_time' =>$_REQUEST['pick_time'],
            'leaving_time' =>$_REQUEST['leaving_time'],
        );
        $car_model->addRentCar($data);
        echo true;

        }
    }

    public function gologoutAction()
    {
        Zend_Session::namespaceUnset('google');
        $this->redirect("/user/login" );  
    }

    public function deleteexperAction()
    {
        $exper_model = new Application_Model_Experience();
        $exper_id = $this->_request->getParam("pid");
        $city_id = $this->_request->getParam('cid');
        $exper_model->deleteexper($exper_id);
        $this->redirect("/index/exper/id/$city_id?/page=1");
    }


}