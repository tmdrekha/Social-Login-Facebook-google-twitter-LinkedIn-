<?php
class ControllerModuletmdSociallogin extends Controller {
	public function index($setting) {
		$this->session->data['socialsetting']=$setting;
			//print_R($setting); die();
		$this->load->language('module/tmdsociallogin');
		$this->load->model('account/customer');
		$this->data['heading_title'] = $this->language->get('heading_title');
		if(isset($this->request->get['route']) && $this->request->get['route']=='checkout/login')
		{
		$this->session->data['route']='checkout/checkout';
		}
		$this->data['text_tax'] = $this->language->get('text_tax');

		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_wishlist'] = $this->language->get('button_wishlist');
		$this->data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');
		$this->data['warning']='';
		if(isset($this->session->data['warning']))
		{
			$this->data['warning']=$this->session->data['warning'];
			unset($this->session->data['warning']);
		}
			
		if ($this->config->get('tmdsociallogin_fbimage')) {
			$fbicon = $this->model_tool_image->resize($this->config->get('tmdsociallogin_fbimage'), $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
			} else {
			$fbicon = $this->model_tool_image->resize('placeholder.png', $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		}
			
		if ($this->config->get('tmdsociallogin_twitimage')) {
			$twiticon = $this->model_tool_image->resize($this->config->get('tmdsociallogin_twitimage'), $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
			} else {
			$twiticon = $this->model_tool_image->resize('placeholder.png', $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		}
			
		if ($this->config->get('tmdsociallogin_gogleimage')) {
		$gogleicon = $this->model_tool_image->resize($this->config->get('tmdsociallogin_gogleimage'), $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		} else {
		$gogleicon = $this->model_tool_image->resize('placeholder.png', $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		}
		
		if ($this->config->get('tmdsociallogin_linkdinimage')) {
		$linkdinicon = $this->model_tool_image->resize($this->config->get('tmdsociallogin_linkdinimage'), $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		} else {
		$linkdinicon = $this->model_tool_image->resize('placeholder.png', $this->config->get('tmdsociallogin_width'),$this->config->get('tmdsociallogin_height'));
		}
		
		
			
		$this->data['iconwidth'] 	  = $this->config->get('tmdsociallogin_width');
		$this->data['iconheight']   = $this->config->get('tmdsociallogin_height');
		$this->data['status']  	  = $setting['status'];
		$this->data['fbimage']   	  = $fbicon;
		$this->data['twitimage']    = $twiticon;
		$this->data['gogleimage']   = $gogleicon;
		$this->data['linkdinimage'] = $linkdinicon;
		$this->data['fbstatus'] 	  = $this->config->get('tmdsociallogin_fbstatus');
		$this->data['twittertitle'] = $this->config->get('tmdsociallogin_twittertitle');
		$this->data['googletitle']  = $this->config->get('tmdsociallogin_googletitle');
		$this->data['linkedintitle']= $this->config->get('tmdsociallogin_linkedintitle');
		$this->data['fbtitle']      = $this->config->get('tmdsociallogin_fbtitle');
		$this->data['twitstatus']   = $this->config->get('tmdsociallogin_twitstatus');
		$this->data['goglestatus']  = $this->config->get('tmdsociallogin_goglestatus');
		$this->data['linkstatus']   = $this->config->get('tmdsociallogin_linkstatus');
		
		
		//Facebook Libery file inculde	
		require_once(DIR_SYSTEM . 'library/tmdsocial/fb/autoload.php');
		
		// Google Libery file inculde
		require_once DIR_SYSTEM.'library/tmdsocial/src/Google_Client.php';
		require_once DIR_SYSTEM.'library/tmdsocial/src/contrib/Google_Oauth2Service.php';
		
		
		
		
		
		//Facebook  Login link code
		$fbconnect = new  Facebook\Facebook(array(
				'app_id'  => $this->config->get('tmdsociallogin_fbapikey'),
				'app_secret' => $this->config->get('tmdsociallogin_fbsecretapi'),
				'default_graph_version' => 'v2.2',
		));
		
		$helper = $fbconnect->getRedirectLoginHelper();

		
		$permissions =array('email'); 
		$this->data['fblink'] =  $helper->getLoginUrl($this->url->link('module/tmdsociallogin/fbredirecturl', '', 'SSL'),$permissions);
		//Facebook  Login link code
		
		
		/* Twitter Login */
						
		$this->data['twitlink'] =  $this->url->link('module/tmdsociallogin/twitredirect', '', 'SSL');
			
		/* Twitter Login */
		
		
		
		/* Linkedin Login */
		$this->data['linkdinlink'] = $this->url->link('module/tmdsociallogin/likinredirect', '', 'SSL');
		 /* Linkedin Login */
		
		/* Google Login link code */
		$gClient = new Google_Client();
		$gClient->setApplicationName($this->data['googletitle']);
		$gClient->setClientId($this->config->get('tmdsociallogin_gogleapikey'));
		$gClient->setClientSecret($this->config->get('tmdsociallogin_gogelsecretapi'));
		$gClient->setRedirectUri($this->url->link('module/tmdsociallogin/gogleredirect', '', 'SSL'));
		$google_oauthV2= new Google_Oauth2Service($gClient);
		$this->data['goglelink']  = $gClient->createAuthUrl();
		/* Google Login link code */
		
		if(!$this->customer->isLogged())
		{
		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/tmdsociallogin.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/tmdsociallogin.tpl';
		} else {
			$this->template = 'default/template/module/tmdsociallogin.tpl';
		}

		$this->render();
		}
		
	}
	
	
	
	//facebook
	
	public function fbredirecturl() {
		
		$setting=$this->session->data['socialsetting'];
		if(isset($this->session->data['route']))
		{
				$location = $this->url->link($this->session->data['route'], "", 'SSL');
		}
		else
		{
		$location = $this->url->link("account/account", "", 'SSL');
		}
		
		if ($this->customer->isLogged())	
			$this->response->redirect($location);
		 
		if(!isset($fb)){
						
		//Facebook Libery file inculde	
		require_once(DIR_SYSTEM . 'library/tmdsocial/fb/autoload.php');
		// Include required libraries
			

	
			$fb = new Facebook\Facebook(array(
					'app_id'  => $this->config->get('tmdsociallogin_fbapikey'),
					'app_secret' => $this->config->get('tmdsociallogin_fbsecretapi'),
					'default_graph_version' => 'v2.2',
			));
			
			$helper = $fb->getRedirectLoginHelper();
		}
	
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		}

		$oAuth2Client = $fb->getOAuth2Client();
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		$fbuser = $tokenMetadata->getField('user_id');
		
		$fbuser_profile = null;
		if ($fbuser){
			try {
				$response = $fb->get("/$fbuser?fields=email,first_name,last_name",$accessToken);
			} catch (FacebookApiException $e) {
				error_log($e);
				$fbuser = null;
			}
		}
		
		$fbuser_profile = $response->getGraphUser();

	
		if($fbuser_profile['id'] && $fbuser_profile['email']){
			$this->load->model('account/customer');
	
			$email = $fbuser_profile['email'];
			
			$customer_info = $this->model_account_customer->getCustomerByEmail($email);
			
			if(!empty($customer_info)){
				
				if ($customer_info && !$customer_info['approved']) {
					$this->session->data['warning'] = 'Customer not Approved';
				}
				else
				{
					if($this->customer->login($email, '', true)){
					$this->response->redirect($location);
					
				}
				}
				
					
				
			}
			
			 else{
	
				
				
				$password = rand();	
				$customerdata=array();
				$customerdata['email'] = $fbuser_profile['email'];
				$customerdata['password'] = $password;
				$customerdata['firstname'] = isset($fbuser_profile['first_name']) ? $fbuser_profile['first_name'] : '';
				$customerdata['lastname'] = isset($fbuser_profile['last_name']) ? $fbuser_profile['last_name'] : '';
				$customerdata['fax'] = '';
				$customerdata['telephone'] = '';
				$customerdata['company'] = '';
				$customerdata['company_id'] = '';
				$customerdata['tax_id'] = '';
				$customerdata['address_1'] = '';
				$customerdata['address_2'] = '';
				$customerdata['city'] = '';
				$customerdata['city_id'] = '';
				$customerdata['postcode'] = '';
				$customerdata['country_id'] = 0;
				$customerdata['zone_id'] = 0;
				$this->model_account_customer->addCustomer($customerdata);
				if($this->customer->login($email, $password, true)){
					$this->response->redirect($location);
					
				}
			}
			}else	
			{
			
			$this->session->data['warning'] = 'Please Varify facebook App';
			}
		$location=	$this->url->link("account/login", "", 'SSL');
		
		$this->response->redirect($location);
		
	}
	
	// google
	public function gogleredirect() {
		
		$setting=$this->session->data['socialsetting'];
		if(isset($this->session->data['route']))
		{
				$location = $this->url->link($this->session->data['route'], "", 'SSL');
		}
		else
		{
		$location = $this->url->link("account/account", "", 'SSL');
		}
		// Google Libery file inculde
		require_once DIR_SYSTEM.'library/tmdsocial/src/Google_Client.php';
		require_once DIR_SYSTEM.'library/tmdsocial/src/contrib/Google_Oauth2Service.php';
		
		/* Google Login link code */
		$gClient = new Google_Client();
		$gClient->setApplicationName($this->config->get('tmdsociallogin_googletitle'));
		$gClient->setClientId($this->config->get('tmdsociallogin_gogleapikey'));
		$gClient->setClientSecret($this->config->get('tmdsociallogin_gogleapikey'));
		$gClient->setRedirectUri($this->url->link('module/tmdsociallogin/gogleredirect', '', 'SSL'));
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		/* Google Login link code */
		
		if(isset($this->request->get['code'])){
			$gClient->authenticate();
			$this->session->data['googletoken'] = $gClient->getAccessToken();
			
		}
		
		if (isset($this->session->data['googletoken'])) {
			$gClient->setAccessToken($this->session->data['googletoken']);
		}

		if ($gClient->getAccessToken()) {
			$userProfile = $google_oauthV2->userinfo->get();
			$this->session->data['googletoken'] = $gClient->getAccessToken();
			
			
			$this->load->model('account/customer');
	
			$email = $userProfile['email'];
			
			$customer_info = $this->model_account_customer->getCustomerByEmail($email);
			
			if(!empty($customer_info)){
				
				if ($customer_info && !$customer_info['approved']) {
					$this->session->data['warning'] = 'Customer not Approved';
				}
				else
				{
					if($this->customer->login($email, '', true)){
					$this->response->redirect($location);
					
				}
				}
				
					
				
			}
			
			 else{
	
				$names=explode(' ',$userProfile['name']);
				
				$password = rand();	
				$customerdata=array();
				$customerdata['email'] = $userProfile['email'];
				$customerdata['password'] = $password;
				$customerdata['firstname'] = isset($names[0]) ? $names[0] : '';
				$customerdata['lastname'] = isset($names[1]) ? $names[1] : '';
				$customerdata['fax'] = '';
				$customerdata['telephone'] = '';
				$customerdata['company'] = '';
				$customerdata['company_id'] = '';
				$customerdata['tax_id'] = '';
				$customerdata['address_1'] = '';
				$customerdata['address_2'] = '';
				$customerdata['city'] = '';
				$customerdata['city_id'] = '';
				$customerdata['postcode'] = '';
				$customerdata['country_id'] = 0;
				$customerdata['zone_id'] = 0;
				$this->model_account_customer->addCustomer($customerdata);
				if($this->customer->login($email, $password, true)){
					$this->response->redirect($location);
					
				}
			}
			
		
		}
		
		
	}
	
	public function twitredirect() {
		$setting = $this->session->data['socialsetting'];
		
		$twitapikey = $this->config->get('tmdsociallogin_twitapikey');
		$twitsecretapi = $this->config->get('tmdsociallogin_twitsecretapi');
		require_once DIR_SYSTEM.'library/tmdsocial/twitter/twitteroauth.php';
		
		//Fresh authentication
		$connection = new TwitterOAuth($twitapikey, $twitsecretapi);
		$request_token = $connection->getRequestToken($this->url->link('module/tmdsociallogin/twitter', '', 'SSL'));

		
		//Received token info from twitter
		$this->session->data['oauth_token'] 			= $request_token['oauth_token'];
		$this->session->data['oauth_token_secret'] 	= $request_token['oauth_token_secret'];
		//Any value other than 200 is failure, so continue only if http code is 200
		if($connection->http_code == '200')
		{
			//redirect user to twitter
			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $twitter_url); 
		}else{
			die("error connecting to twitter! try again later!");
		}
		
		
	}
	
	public function twitter() {
	
		$setting=$this->session->data['socialsetting'];
		if(isset($this->session->data['route']))
		{
				if($this->session->data['route']=='checkout/login')
				{
					$this->session->data['route']='checkout/checkout';
				}
				$location = $this->url->link($this->session->data['route'], "", 'SSL');
		}
		else
		{
		$location = $this->url->link("account/account", "", 'SSL');
		}
		
		require_once DIR_SYSTEM.'library/tmdsocial/twitter/twitteroauth.php';
		
		
		
		if (!empty($this->request->get['oauth_verifier']) && !empty($this->session->data['oauth_token']) && !empty($this->session->data['oauth_token_secret'])) {
			
			
			
			$twitteroauth = new TwitterOAuth($setting['twitapikey'], $setting['twitsecretapi'], $this->session->data['oauth_token'], $this->session->data['oauth_token_secret']);
			
				
			$access_token = $twitteroauth->getAccessToken($this->request->get['oauth_verifier']);
			$this->session->data['access_token'] = $access_token;
			$params = array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true');
			$user_info = $twitteroauth->get('account/verify_credentials',$params);
			
			
			if (isset($user_info->error)) {
			
			} else {
				$twiter_id = $user_info->id;
				$name = $user_info->name;
				
				$name_arr = explode(" ", $name);
				$f_name = array_shift($name_arr);
				$l_name = implode(" ", $name_arr);
				
				
				if(isset($user_info->email))
				{
					$email = $user_info->email;
					
				}
				else
				{
					$this->session->data['warning'] = 'Need Speical verification for twitter';
					$this->response->redirect($this->url->link("account/login", "", 'SSL'));
				}
				
				
				
				$this->load->model('account/customer');
				
			
				
				
				
				
			if(isset($this->session->data['route']))
			{
					if($this->session->data['route']=='checkout/login')
					{
						$this->session->data['route']='checkout/checkout';
					}
					$location = $this->url->link($this->session->data['route'], "", 'SSL');
			}
			else
			{
			$location = $this->url->link("account/account", "", 'SSL');
			}	
				
			$customer_info = $this->model_account_customer->getCustomerByEmail($email);
			
			if(!empty($customer_info)){
				
				if ($customer_info && !$customer_info['approved']) {
					$this->session->data['warning'] = 'Customer not Approved';
				}
				else
				{
					
					if($this->customer->login($email,'', true)){
						
						$this->response->redirect($location);
						
					}
					
				}
			
			
			} else{
				$twiter_id = $user_info->id;
				$name = $user_info->name;
				
				$name_arr = explode(" ", $name);
				$f_name = array_shift($name_arr);
				$l_name = implode(" ", $name_arr);
				
				$this->request->post['email'] = $email;
				$password =$twiter_id;	
				$insertentry=array();
				$insertentry['email'] = $email;
				$insertentry['password'] = $password;
				$insertentry['firstname'] = isset($f_name) ? $f_name : '';
				$insertentry['lastname'] = isset($l_name) ? $l_name : '';
				$insertentry['fax'] = '';
				$insertentry['telephone'] = '';
				$insertentry['company'] = '';
				$insertentry['company_id'] = '';
				$insertentry['tax_id'] = '';
				$insertentry['address_1'] = '';
				$insertentry['address_2'] = '';
				$insertentry['city'] = '';
				$insertentry['city_id'] = '';
				$insertentry['postcode'] = '';
				$insertentry['country_id'] = 0;
				$insertentry['zone_id'] = 0;
	
				$this->model_account_customer->addCustomer($insertentry);
				$this->config->set('config_customer_approval',$config_customer_approval);
	
				if($this->customer->login($email, '', true)){
					$this->response->redirect($location);
					
				}
			}
				
			}
		} else {
			
			$this->response->redirect($this->url->link('common/home', '', 'SSL'));
			
		}
	}
	 
	
	/* LinkedIn */
	
	public function likinredirect() {
		$setting=$this->session->data['socialsetting'];
		if(isset($this->session->data['route']))
		{
				$location = $this->url->link($this->session->data['route'], "", 'SSL');
		}
		else
		{
		$location = $this->url->link("account/account", "", 'SSL');
		}
		
		// linkdin Libery file inculde
		require_once DIR_SYSTEM.'library/tmdsocial/linkedIn/http.php';
		require_once DIR_SYSTEM.'library/tmdsocial/linkedIn/oauth_client.php';
		
		
		$client = new oauth_client_class;
		$client->debug = false;
		$client->debug_http = true;
		$client->redirect_uri = $this->url->link('module/tmdsociallogin/likinredirect', '', 'SSL');
		$client->client_id = $this->config->get('tmdsociallogin_linkdinapikey');
		$application_line = __LINE__;
		$client->client_secret = $this->config->get('tmdsociallogin_linkdinsecretapi');
		if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
		die('Please go to LinkedIn Apps page https://www.linkedin.com/secure/developer?newapp= , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to Consumer key and client_secret with Consumer secret. '.
			'The Callback URL must be '.$client->redirect_uri.' Make sure you enable the '.
			'necessary permissions to execute the API calls your application needs.');
		$client->scope = 'r_basicprofile r_emailaddress';
		if (($success = $client->Initialize())) {
		  if (($success = $client->Process())) {
			if (strlen($client->authorization_error)) {
			  $client->error = $client->authorization_error;
			  $success = false;
			} elseif (strlen($client->access_token)) {
			  $success = $client->CallAPI(
							'http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)', 
							'GET', array(
								'format'=>'json'
							), array('FailOnAccessError'=>true), $user);
			}
		  }
		   $success = $client->Finalize($success);
		}
			if($success)
			{
			
			$this->load->model('account/customer');
			$email = $user->emailAddress;
			
			$customer_info = $this->model_account_customer->getCustomerByEmail($email);
			
			if(!empty($customer_info)){
				
				if ($customer_info && !$customer_info['approved']) {
					$this->session->data['warning'] = 'Customer not Approved';
				}
				else
				{
					if($this->customer->login($email, '', true)){
					$this->response->redirect($location);
					
				}
				}
				
					
				
			}
			
			 else{
	
			
				
				$password = rand();	
				$customerdata=array();
				$customerdata['email'] = $email;
				$customerdata['password'] = $password;
				$customerdata['firstname'] = isset($user->firstName) ? $user->firstName : '';
				$customerdata['lastname'] = isset($user->lastName) ?$user->lastName  : '';
				$customerdata['fax'] = '';
				$customerdata['telephone'] = '';
				$customerdata['company'] = '';
				$customerdata['company_id'] = '';
				$customerdata['tax_id'] = '';
				$customerdata['address_1'] = '';
				$customerdata['address_2'] = '';
				$customerdata['city'] = '';
				$customerdata['city_id'] = '';
				$customerdata['postcode'] = '';
				$customerdata['country_id'] = 0;
				$customerdata['zone_id'] = 0;
				$this->model_account_customer->addCustomer($customerdata);
				if($this->customer->login($email, $password, true)){
					$this->response->redirect($location);
					
				}
			}
			
		
		}

	
	}

	private function clean_decode($server)
	{
	return $server;
	}
	
}