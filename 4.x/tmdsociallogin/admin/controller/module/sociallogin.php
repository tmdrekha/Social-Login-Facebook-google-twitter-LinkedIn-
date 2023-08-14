<?php
namespace Opencart\Admin\Controller\Extension\Tmdsociallogin\Module;
// Lib Include 
require_once(DIR_EXTENSION.'/tmdsociallogin/system/library/tmd/system.php');
// Lib Include 
class Sociallogin extends \Opencart\System\Engine\Controller {
	public function index():void {
		$this->registry->set('tmd', new  \Tmdsociallogin\System\Library\Tmd\System($this->registry));
		$keydata=array(
		'code'=>'tmdkey_sociallogin',
		'eid'=>'Mjc1MjE=',
		'route'=>'extension/tmdsociallogin/module/sociallogin',
		);
		$sociallogin=$this->tmd->getkey($keydata['code']);
		$data['getkeyform']=$this->tmd->loadkeyform($keydata);
		
		$this->load->language('extension/tmdsociallogin/module/sociallogin');

		$this->document->setTitle($this->language->get('heading_title1'));
		
		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];
		
			unset($this->session->data['warning']);
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token='.$this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token='.$this->session->data['user_token'].'&type=module')
		];

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/tmdsociallogin/module/sociallogin', 'user_token='.$this->session->data['user_token'])
			];
		} else {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/tmdsociallogin/module/sociallogin', 'user_token='.$this->session->data['user_token'].'&module_id='.$this->request->get['module_id'])
			];
		}

		if(VERSION>='4.0.2.0'){
			if (!isset($this->request->get['module_id'])) {
			$data['save'] = $this->url->link('extension/tmdsociallogin/module/sociallogin.save', 'user_token='.$this->session->data['user_token']);
		} else {
			$data['save'] = $this->url->link('extension/tmdsociallogin/module/sociallogin.save', 'user_token='.$this->session->data['user_token'].'&module_id='.$this->request->get['module_id']);
		}
		}else{
			if (!isset($this->request->get['module_id'])) {
			$data['save'] = $this->url->link('extension/tmdsociallogin/module/sociallogin|save', 'user_token='.$this->session->data['user_token']);
		} else {
			$data['save'] = $this->url->link('extension/tmdsociallogin/module/sociallogin|save', 'user_token='.$this->session->data['user_token'].'&module_id='.$this->request->get['module_id']);
		}
		}	

		$data['back'] = $this->url->link('marketplace/extension', 'user_token='.$this->session->data['user_token'].'&type=module');

		if (isset($this->request->get['module_id'])) {
			$this->load->model('setting/module');

			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

		// fields

		if (isset($module_info['name'])) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($module_info['width'])) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = '';
		}

		if (isset($module_info['height'])) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = '';
		}

		if (isset($module_info['status'])) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		if (isset($module_info['fbtitle'])) {
			$data['fbtitle'] = $module_info['fbtitle'];
		} else {
			$data['fbtitle'] = '';
		}

		if (isset($module_info['fbtitle'])) {
			$data['fbtitle'] = $module_info['fbtitle'];
		} else {
			$data['fbtitle'] = '';
		}

		if (!empty($module_info)) {
			$data['fbimage'] = $module_info['fbimage'];
		} else {
			$data['fbimage'] = '';
		}

		if (!empty($module_info)) {
			$data['fbapikey'] = $module_info['fbapikey'];
		} else {
			$data['fbapikey'] = '';
		}

		if (!empty($module_info)) {
			$data['fbapisecret'] = $module_info['fbapisecret'];
		} else {
			$data['fbapisecret'] = '';
		}
		
		if (!empty($module_info)) {
			$data['fbstatus'] = $module_info['fbstatus'];
		} else {
			$data['fbstatus'] = '';
		}

		if (!empty($module_info)) {
			$data['twittertitle'] = $module_info['twittertitle'];
		} else {
			$data['twittertitle'] = '';
		}

		if (!empty($module_info)) {
			$data['twitimage'] = $module_info['twitimage'];
		} else {
			$data['twitimage'] = '';
		}

		if (!empty($module_info)) {
			$data['twitapikey'] = $module_info['twitapikey'];
		} else {
			$data['twitapikey'] = '';
		}

		if (!empty($module_info)) {
			$data['twitapisecret'] = $module_info['twitapisecret'];
		} else {
			$data['twitapisecret'] = '';
		}
		
		if (!empty($module_info)) {
			$data['twitstatus'] = $module_info['twitstatus'];
		} else {
			$data['twitstatus'] = '';
		}

		if (!empty($module_info)) {
			$data['googletitle'] = $module_info['googletitle'];
		} else {
			$data['googletitle'] = '';
		}

		if (!empty($module_info)) {
			$data['googleimage'] = $module_info['googleimage'];
		} else {
			$data['googleimage'] = '';
		}

		if (!empty($module_info)) {
			$data['googleapikey'] = $module_info['googleapikey'];
		} else {
			$data['googleapikey'] = '';
		}

		if (!empty($module_info)) {
			$data['googleapisecret'] = $module_info['googleapisecret'];
		} else {
			$data['googleapisecret'] = '';
		}
		
		if (!empty($module_info)) {
			$data['googlestatus'] = $module_info['googlestatus'];
		} else {
			$data['googlestatus'] = '';
		}

		if (!empty($module_info)) {
			$data['linkedintitle'] = $module_info['linkedintitle'];
		} else {
			$data['linkedintitle'] = '';
		}

		if (!empty($module_info)) {
			$data['linkedinimage'] = $module_info['linkedinimage'];
		} else {
			$data['linkedinimage'] = '';
		}

		if (!empty($module_info)) {
			$data['linkedinapikey'] = $module_info['linkedinapikey'];
		} else {
			$data['linkeinapikey'] = '';
		}

		if (!empty($module_info)) {
			$data['linkedinapisecret'] = $module_info['linkedinapisecret'];
		} else {
			$data['linkedinapisecret'] = '';
		}
		
		if (!empty($module_info)) {
			$data['linkstatus'] = $module_info['linkstatus'];
		} else {
			$data['linkstatus'] = '';
		}
		
		$data['fbcallback'] = HTTP_CATALOG.'index.php?route=extension/tmdsociallogin/module/sociallogin|fbredirecturl';

		$data['googlecallback'] = HTTP_CATALOG.'index.php?route=extension/tmdsociallogin/tmd/googleredirect';
		
		$data['twitcallback'] = HTTP_CATALOG.'index.php';
		
		$data['linkedincallback'] = HTTP_CATALOG.'index.php?route=extension/tmdsociallogin/module/sociallogin|likinredirect';

		// image

		$this->load->model('tool/image');

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 500, 500);

		if (is_file(DIR_IMAGE.html_entity_decode($data['fbimage'], ENT_QUOTES, 'UTF-8'))) {
			$data['thumb'] = $this->model_tool_image->resize(html_entity_decode($data['fbimage'], ENT_QUOTES, 'UTF-8'), 500, 500);
		} else {
			$data['thumb'] = $data['placeholder'];
		}

		if (is_file(DIR_IMAGE.html_entity_decode($data['twitimage'], ENT_QUOTES, 'UTF-8'))) {
			$data['twitthumb'] = $this->model_tool_image->resize(html_entity_decode($data['twitimage'], ENT_QUOTES, 'UTF-8'), 500, 500);
		} else {
			$data['twitthumb'] = $data['placeholder'];
		}

		if (is_file(DIR_IMAGE.html_entity_decode($data['googleimage'], ENT_QUOTES, 'UTF-8'))) {
			$data['googlethumb'] = $this->model_tool_image->resize(html_entity_decode($data['googleimage'], ENT_QUOTES, 'UTF-8'), 500, 500);
		} else {
			$data['googlethumb'] = $data['placeholder'];
		}

		if (is_file(DIR_IMAGE.html_entity_decode($data['linkedinimage'], ENT_QUOTES, 'UTF-8'))) {
			$data['linkedinthumb'] = $this->model_tool_image->resize(html_entity_decode($data['linkedinimage'], ENT_QUOTES, 'UTF-8'), 500, 500);
		} else {
			$data['linkedinthumb'] = $data['placeholder'];
		}

		$data['user_token'] = $this->session->data['user_token'];

		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/tmdsociallogin/module/sociallogin', $data));
	}
	
	public function install() {
		// Fix permissions
		$this->load->model('user/user_group');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/tmdsociallogin/module/sociallogin');
		$this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/tmdsociallogin/module/sociallogin');
		
		//admin layout position add Event
		$this->model_setting_event->deleteEventByCode('module_sociallogin_layout');
		if(VERSION>='4.0.2.0'){
			$eventaction='extension/tmdsociallogin/module/sociallogin.layoutnew';
		}
		else{
			$eventaction='extension/tmdsociallogin/module/sociallogin|layoutnew';
		}
		$eventrequest=[
					'code'=>'module_sociallogin_layout',
					'description'=>'Sociallogin Admin Layout Positions',
					'trigger'=>'admin/view/design/layout_form/before',
					'action'=>$eventaction,
					'status'=>'1',
					'sort_order'=>'1',
				];
				
		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('module_sociallogin_layout', 'Sociallogin Admin Layout Positions', 'admin/view/design/layout_form/before', 'extension/tmdsociallogin/module/sociallogin|layoutnew', true, 1);
		}else{
			$this->model_setting_event->addEvent($eventrequest);
		}
		
		//front account login Event
		$this->model_setting_event->deleteEventByCode('tmd_socialaccountlogin');
		if(VERSION>='4.0.2.0'){
			$eventaction='extension/tmdsociallogin/tmd/socialaccountlogin.accountlogin';
		}
		else{
			$eventaction='extension/tmdsociallogin/tmd/socialaccountlogin|accountlogin';
		}
		$eventrequest=[
					'code'=>'tmd_socialaccountlogin',
					'description'=>'Sociallogin Account Login',
					'trigger'=>'catalog/view/account/login/before',
					'action'=>$eventaction,
					'status'=>'1',
					'sort_order'=>'1',
				];
				
		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('tmd_socialaccountlogin', 'Sociallogin Account Login', 'catalog/view/account/login/before', 'extension/tmdsociallogin/tmd/socialaccountlogin|accountlogin', true, 1);
		}else{
			$this->model_setting_event->addEvent($eventrequest);
		}
		
		//front checkout Event
		$this->model_setting_event->deleteEventByCode('tmd_socialcheckout');
		if(VERSION>='4.0.2.0'){
			$eventaction='extension/tmdsociallogin/tmd/socialaccountlogin.checkout';
		}
		else{
			$eventaction='extension/tmdsociallogin/tmd/socialaccountlogin|checkout';
		}
		$eventrequest=[
					'code'=>'tmd_socialcheckout',
					'description'=>'Sociallogin Checkout',
					'trigger'=>'catalog/view/checkout/checkout/before',
					'action'=>$eventaction,
					'status'=>'1',
					'sort_order'=>'1',
				];
				
		if(VERSION=='4.0.0.0')
		{
		$this->model_setting_event->addEvent('tmd_socialcheckout', 'Sociallogin Checkout', 'catalog/view/checkout/checkout/before', 'extension/tmdsociallogin/tmd/socialaccountlogin|checkout', true, 1);
		}else{
			$this->model_setting_event->addEvent($eventrequest);
		}
	}
	
	public function uninstall() {
		// Fix permissions
		$this->load->model('user/user_group');
		$this->model_user_user_group->removePermission($this->user->getGroupId(), 'access', 'extension/tmdsociallogin/module/sociallogin');
		$this->model_user_user_group->removePermission($this->user->getGroupId(), 'modify', 'extension/tmdsociallogin/module/sociallogin');
		
		$this->model_setting_event->deleteEventByCode('module_sociallogin_layout');
	}
	
	public function layoutnew(string &$route, array &$args, mixed &$output): void {	
	$this->load->language('extension/tmdsociallogin/module/sociallogin');
		$template_buffer = $this->getTemplateBuffer($route,$output);
		$layoutcode=file_get_contents(DIR_EXTENSION.'tmdsociallogin/admin/view/template/design/layout.twig');
		$find='<div class="col-lg-6 col-md-4 col-sm-12">';
		$replace='<div class="col-lg-6 col-md-4 col-sm-12">'.$layoutcode;
		$output = str_replace( $find, $replace, $template_buffer );

		$find="$('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom').on('change', 'select[name*=\'code\']', function() {";
				 $replace="$('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom,#module-column-login').on('change', 'select[name*=\'code\']', function() {"; 
				 $output = str_replace( $find, $replace, $output );
		}
		
		protected function isAdmin() {
		return defined( 'DIR_CATALOG' ) ? true : false;
	}
	
	protected function getTemplateBuffer( $route, $event_template_buffer ) {
		// if there already is a modified template from view/*/before events use that one
		if ($event_template_buffer) {
			return $event_template_buffer;
		}

		// load the template file (possibly modified by ocmod and vqmod) into a string buffer
		if ($this->isAdmin()) {
			$dir_template = DIR_TEMPLATE;
		} else {
			if ($this->config->get('config_theme') == 'default') {
				$theme = $this->config->get('theme_default_directory');
			} else {
				$theme = $this->config->get('config_theme');
			}
			$dir_template = DIR_TEMPLATE . $theme . '/template/';
		}
		$template_file = $dir_template . $route . '.twig';
		if (file_exists
		
		( $template_file ) && is_file( $template_file )) {
			
			return file_get_contents( $template_file );
		}
		if ($this->isAdmin()) {
			trigger_error("Cannot find template file for route '$route'");
			exit;
		}
		 $dir_template = DIR_TEMPLATE . 'default/template/';
		 $template_file = $dir_template . $route . '.twig';
		if (file_exists( $template_file ) && is_file( $template_file )) {
			
			return file_get_contents( $template_file );
		}
		trigger_error("Cannot find template file for route '$route'");
		exit;
	}

	public function save():void {
		$this->load->language('extension/tmdsociallogin/module/sociallogin');

		$json = [];

		if (!$this->user->hasPermission('modify', 'extension/tmdsociallogin/module/sociallogin')) {
			$json['error']['warning'] = $this->language->get('error_permission');
		}
		
		$sociallogin=$this->config->get('tmdkey_sociallogin');
		if (empty(trim($sociallogin))) {			
		$json['error'] ='Module will Work after add License key!';
		}

		if ((strlen($this->request->post['name']) < 3) || (strlen($this->request->post['name']) > 64)) {
			$json['error']['name'] = $this->language->get('error_name');
		}

		if (!$json) {
			$this->load->model('setting/module');

			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('tmdsociallogin.sociallogin', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function keysubmit() {
		$json = array(); 
		
      	if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$keydata=array(
			'code'=>'tmdkey_sociallogin',
			'eid'=>'Mjc1MjE=',
			'route'=>'extension/tmdsociallogin/module/sociallogin',
			'moduledata_key'=>$this->request->post['moduledata_key'],
			);
			$this->registry->set('tmd', new  \Tmdsociallogin\System\Library\Tmd\System($this->registry));
		
            $json=$this->tmd->matchkey($keydata);       
		} 
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}
