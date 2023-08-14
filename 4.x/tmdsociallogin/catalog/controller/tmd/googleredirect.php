<?php
namespace Opencart\Catalog\Controller\Extension\Tmdsociallogin\Tmd;
use \Opencart\System\Helper as Helper;
// Google
require_once(DIR_EXTENSION.'/tmdsociallogin/system/library/tmdsocial/src/Google_Client.php');
require_once(DIR_EXTENSION.'/tmdsociallogin/system/library/tmdsocial/src/contrib/Google_Oauth2Service.php');
session_start();
class Googleredirect extends \Opencart\System\Engine\Controller {
// google
	public function index() {
		
		$setting=$this->cache->get('tmdsociallogin');
		$location = $this->url->link("account/account", "", true);
	
     	$option = [];
		setcookie($this->config->get('session_name'), session_id(), $option);
		
		
		/* Google Login link code */
		$gClient = new \Google_Client();
		$gClient->setApplicationName($setting['googletitle']);
		$gClient->setClientId($setting['googleapikey']);
		$gClient->setClientSecret($setting['googleapisecret']);
		$gClient->setRedirectUri($this->url->link('extension/tmdsociallogin/tmd/googleredirect', '', true));
		$google_oauthV2 = new \Google_Oauth2Service($gClient);
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
				
				if ($customer_info && !$customer_info['status']) {
					$this->session->data['warning'] = 'Customer not Approved';
				}
				else
				{
				     $_SESSION['customer_id']=$customer_info['customer_id'];
				   
				    	// Add customer details into session
			$this->session->data['customer'] = [
				'customer_id'       => $customer_info['customer_id'],
				'customer_group_id' => $customer_info['customer_group_id'],
				'firstname'         => $customer_info['firstname'],
				'lastname'          => $customer_info['lastname'],
				'email'             => $customer_info['email'],
				'telephone'         => $customer_info['telephone'],
				'custom_field'      => $customer_info['custom_field']
			];

				    if(VERSION>='4.0.1.1'){
				
					$this->session->data['customer_token'] = Helper\General\token(26);
				    }
				    $this->response->redirect($location.'&customer_token='.	$this->session->data['customer_token']);
				
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
				    
				    if(VERSION>='4.0.1.1'){
				
					$this->session->data['customer_token'] = Helper\General\token(26);
				    }
				$this->response->redirect($location.'&customer_token'.	$this->session->data['customer_token']);
					
				}
			}

		}

	}
	
}
