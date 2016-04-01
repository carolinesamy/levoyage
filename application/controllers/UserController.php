<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
         $authorization = Zend_Auth::getInstance();
        $fbsession = new Zend_Session_Namespace('facebook');
        if (!$authorization->hasIdentity() &&
        !isset($fbsession->fname)) {
        if ($this->_request->getActionName() != 'login' &&
        $this->_request->getActionName() != 'add' && $this->_request->getActionName() != 'fbauth') {
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
        // action body
		$form = new Application_Form_Register();
		$request = $this->getRequest();
		if($request->isPost()){
			if($form->isValid($request->getPost())){
				$std_model = new Application_Model_User();
				$std_model-> adduser($request->getParams());
				$this->redirect();
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
                $username = $this->_request->getParam('username');
                $password = $this->_request->getParam('password');

                // get the default db adapter
                $db = Zend_Db_Table::getDefaultAdapter( );
                //create the auth adapter
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, "user", "username",
                "password");
                //set the email and password
                $authAdapter->setIdentity($username);
                $authAdapter->setCredential($password);

                $result = $authAdapter->authenticate();
                if ($result->isValid( )) {

                //if the user is valid register his info in session
                $auth = Zend_Auth::getInstance( );//if the user is valid register his info in session
                $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                // write in session email & id & first_name
                $storage->write($authAdapter->getResultRowObject(array('email',
                'username')));
                // redirect to root index/index
                return $this->redirect();
            } else {
                     // if user is not valid send error message to view
                     $this->view->error_message = "Invalid username or Password!";
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
$fpsession->fname = $userNode->getName();
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
       $settings = array(
		'oauth_access_token' => "715304296280100865-2E8xbUznLTPrwoqXkRUaSPR7MYfKwS2",
		'oauth_access_token_secret' => "vT0r0aTEccIfYRJRu5fchqprcQl3Slr1e939G5rTnRxopkQAbU",
		'consumer_key' => "WY7NpcSMyrEpOMhXvdMixoxqJ",
		'consumer_secret' => "vsrOIbN1adtWoqyhAJuFH44WBS3xrMarYtvV0RhO9hA5C"
		);
		$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
		$requestMethod = "GET";
		if (isset($_GET['user']))  {$user = $_GET['user'];}  else {$user  = "iagdotme";}
		$getfield = "?screen_name=$user";
		$twitter = new TwitterAPIExchange($settings);
		$string = json_decode($twitter->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest(),$assoc = TRUE);
		if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
		foreach($string as $items)
         {
	        echo "Tweeted by: ". $items['user']['name']."<br />";
	        echo "Screen name: ". $items['user']['screen_name']."<br />";
         }
    }

    public function commAction()
    {
        // action body
    }


}















