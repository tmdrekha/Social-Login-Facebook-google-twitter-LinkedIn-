<?php
class ControllerModuleTmdsocialLogin extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/tmdsociallogin');

		$this->document->setTitle($this->language->get('heading_title1'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('tmdsociallogin', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['heading_title1'] = $this->language->get('heading_title1');
		
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
	
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['tab_setting'] = $this->language->get('tab_setting');
		$this->data['tab_facbook'] = $this->language->get('tab_facbook');
		$this->data['tab_twitter'] = $this->language->get('tab_twitter');
		$this->data['tab_google'] = $this->language->get('tab_google');
		$this->data['tab_linkedin'] = $this->language->get('tab_linkedin');
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['entry_title'] = $this->language->get('entry_title');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_apikey'] = $this->language->get('entry_apikey');
		$this->data['entry_apisecret'] = $this->language->get('entry_apisecret');
		$this->data['entry_twapikey'] = $this->language->get('entry_twapikey');
		$this->data['entry_twapisecret'] = $this->language->get('entry_twapisecret');
		$this->data['entry_goapikey'] = $this->language->get('entry_goapikey');
		$this->data['entry_goapisecret'] = $this->language->get('entry_goapisecret');
		$this->data['entry_liapikey'] = $this->language->get('entry_liapikey');
		$this->data['entry_liapisecret'] = $this->language->get('entry_liapisecret');
		$this->data['entry_iconsize'] = $this->language->get('entry_iconsize');
		$this->data['text_fblink'] = $this->language->get('text_fblink');
		$this->data['text_twitlink'] = $this->language->get('text_twitlink');
		$this->data['text_gogllink'] = $this->language->get('text_gogllink');
		$this->data['text_linkdinlink'] = $this->language->get('text_linkdinlink');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');	
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		
		
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_column_login'] = $this->language->get('text_column_login');		
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		
		
		if (isset($this->error['tmdsociallogin_fbapikey'])) {
			$this->data['error_fbapikey'] = $this->error['tmdsociallogin_fbapikey'];
		} else {
			$this->data['error_fbapikey'] = '';
		}
		
		if (isset($this->error['tmdsociallogin_fbsecretapi'])) {
			$this->data['error_fbsecretapi'] = $this->error['tmdsociallogin_fbsecretapi'];
		} else {
			$this->data['error_fbsecretapi'] = '';
		}
		
		if (isset($this->error['tmdsociallogin_twitapikey'])) {
			$this->data['error_twitapikey'] = $this->error['tmdsociallogin_twitapikey'];
		} else {
			$this->data['error_twitapikey'] = '';
		}
		
		
		if (isset($this->error['tmdsociallogin_twitsecretapi'])) {
			$this->data['error_twitsecret'] = $this->error['tmdsociallogin_twitsecretapi'];
		} else {
			$this->data['error_twitsecret'] = '';
		}
		
	
		if (isset($this->error['tmdsociallogin_gogleapikey'])) {
			$this->data['error_gogleapikey'] = $this->error['tmdsociallogin_gogleapikey'];
		} else {
			$this->data['error_gogleapikey'] = '';
		}
		
		if (isset($this->error['tmdsociallogin_gogelsecretapi'])) {
			$this->data['error_goglesecret'] = $this->error['tmdsociallogin_gogelsecretapi'];
		} else {
			$this->data['error_goglesecret'] = '';
		}
		
		if (isset($this->error['tmdsociallogin_linkdinapikey'])) {
			$this->data['error_linkdinapikey'] = $this->error['tmdsociallogin_linkdinapikey'];
		} else {
			$this->data['error_linkdinapikey'] = '';
		}
		
		if (isset($this->error['tmdsociallogin_linkdinsecretapi'])) {
			$this->data['error_linkdinsecret'] = $this->error['tmdsociallogin_linkdinsecretapi'];
		} else {
			$this->data['error_linkdinsecret'] = '';
		}
		
		
		
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title1'),
			'href'      => $this->url->link('module/tmdsociallogin', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);			
		

		
		$this->data['action'] = $this->url->link('module/tmdsociallogin', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		//// Social login ////
					
		if (isset($this->request->post['tmdsociallogin_width'])) {
			$this->data['tmdsociallogin_width'] = $this->request->post['tmdsociallogin_width'];
		} elseif ($this->config->get('tmdsociallogin_width')) { 
			$this->data['tmdsociallogin_width'] = $this->config->get('tmdsociallogin_width');
		} else{
			
			$this->data['tmdsociallogin_width'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_height'])) {
			$this->data['tmdsociallogin_height'] = $this->request->post['tmdsociallogin_height'];
		} elseif ($this->config->get('tmdsociallogin_height')) { 
			$this->data['tmdsociallogin_height'] = $this->config->get('tmdsociallogin_height');
		}
		 else{
			
			$this->data['tmdsociallogin_height'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_fbtitle'])) {
			$this->data['tmdsociallogin_fbtitle'] = $this->request->post['tmdsociallogin_fbtitle'];
		} elseif ($this->config->get('tmdsociallogin_fbtitle')) {
			$this->data['tmdsociallogin_fbtitle'] = $this->config->get('tmdsociallogin_fbtitle');
		} else{
			
			$this->data['tmdsociallogin_fbtitle'] ='';
		}
			
		if (isset($this->request->post['tmdsociallogin_twittertitle'])) {
			$this->data['tmdsociallogin_twittertitle'] = $this->request->post['twittertitle'];
		} elseif ($this->config->get('tmdsociallogin_twittertitle')) {
			$this->data['tmdsociallogin_twittertitle'] = $this->config->get('tmdsociallogin_twittertitle');
		} else{
			
			$this->data['tmdsociallogin_twittertitle'] ='';
		}
				
		if (isset($this->request->post['tmdsociallogin_googletitle'])) {
			$this->data['tmdsociallogin_googletitle'] = $this->request->post['tmdsociallogin_googletitle'];
		}  elseif ($this->config->get('tmdsociallogin_googletitle')) {
			$this->data['tmdsociallogin_googletitle'] = $this->config->get('tmdsociallogin_googletitle');
		} else{
			
			$this->data['tmdsociallogin_googletitle'] ='';
		}
					
		if (isset($this->request->post['tmdsociallogin_linkedintitle'])) {
			$this->data['tmdsociallogin_linkedintitle'] = $this->request->post['tmdsociallogin_linkedintitle'];
		}  elseif ($this->config->get('tmdsociallogin_linkedintitle')) {
			$this->data['tmdsociallogin_linkedintitle'] = $this->config->get('tmdsociallogin_linkedintitle');
		} else{
			
			$this->data['tmdsociallogin_linkedintitle'] ='';
		}
				
		
		if (isset($this->request->post['tmdsociallogin_fbstatus'])) {
			$this->data['tmdsociallogin_fbstatus'] = $this->request->post['tmdsociallogin_fbstatus'];
		}  elseif ($this->config->get('tmdsociallogin_fbstatus')) {
			$this->data['tmdsociallogin_fbstatus'] = $this->config->get('tmdsociallogin_fbstatus');
		}else{
			
			$this->data['tmdsociallogin_fbstatus'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_twitstatus'])) {
			$this->data['tmdsociallogin_twitstatus'] = $this->request->post['tmdsociallogin_twitstatus'];
		}  elseif ($this->config->get('tmdsociallogin_twitstatus')) {
			$this->data['tmdsociallogin_twitstatus'] = $this->config->get('tmdsociallogin_twitstatus');
		}
		else{
			
			$this->data['tmdsociallogin_twitstatus'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_goglestatus'])) {
			$this->data['tmdsociallogin_goglestatus'] = $this->request->post['tmdsociallogin_goglestatus'];
		} elseif ($this->config->get('tmdsociallogin_goglestatus')) {
			$this->data['tmdsociallogin_goglestatus'] = $this->config->get('tmdsociallogin_goglestatus');
		}
		else{
			
			$this->data['tmdsociallogin_goglestatus'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_linkstatus'])) {
			$this->data['tmdsociallogin_linkstatus'] = $this->request->post['tmdsociallogin_linkstatus'];
		} elseif ($this->config->get('tmdsociallogin_linkstatus')) {
			$this->data['tmdsociallogin_linkstatus'] = $this->config->get('tmdsociallogin_linkstatus');
		}
		else{
			
			$this->data['tmdsociallogin_linkstatus'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_fbimage'])) {
			$this->data['tmdsociallogin_fbimage'] = $this->request->post['tmdsociallogin_fbimage'];
		} elseif ($this->config->get('tmdsociallogin_fbimage')) {
			$this->data['tmdsociallogin_fbimage'] = $this->config->get('tmdsociallogin_fbimage');
		}
		else{
			
			$this->data['tmdsociallogin_fbimage'] ='';
		}
			
		if (isset($this->request->post['tmdsociallogin_twitimage'])) {
			$this->data['tmdsociallogin_twitimage'] = $this->request->post['tmdsociallogin_twitimage'];
		} elseif ($this->config->get('tmdsociallogin_twitimage')) {
			$this->data['tmdsociallogin_twitimage'] = $this->config->get('tmdsociallogin_twitimage');
		}
		
		else{
			
			$this->data['tmdsociallogin_twitimage'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_gogleimage'])) {
			$this->data['tmdsociallogin_gogleimage'] = $this->request->post['tmdsociallogin_gogleimage'];
		} elseif ($this->config->get('tmdsociallogin_gogleimage')) {
			$this->data['tmdsociallogin_gogleimage'] = $this->config->get('tmdsociallogin_gogleimage');
		}
		
		else{
			
			$this->data['tmdsociallogin_gogleimage'] ='';
		}
	
		if (isset($this->request->post['tmdsociallogin_linkdinimage'])) {
			$this->data['tmdsociallogin_linkdinimage'] = $this->request->post['tmdsociallogin_linkdinimage'];
		} elseif ($this->config->get('tmdsociallogin_linkdinimage')) {
			$this->data['tmdsociallogin_linkdinimage'] = $this->config->get('tmdsociallogin_linkdinimage');
		}
		else{
			
			$this->data['tmdsociallogin_linkdinimage'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_fbapikey'])) {
			$this->data['tmdsociallogin_fbapikey'] = $this->request->post['tmdsociallogin_fbapikey'];
		} elseif ($this->config->get('tmdsociallogin_fbapikey')) {
			$this->data['tmdsociallogin_fbapikey'] = $this->config->get('tmdsociallogin_fbapikey');
		}
		else{
			
			$this->data['tmdsociallogin_fbapikey'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_fbsecretapi'])) {
			$this->data['tmdsociallogin_fbsecretapi'] = $this->request->post['tmdsociallogin_fbsecretapi'];
		} elseif ($this->config->get('tmdsociallogin_fbsecretapi')) {
			$this->data['tmdsociallogin_fbsecretapi'] = $this->config->get('tmdsociallogin_fbsecretapi');
		}
		else{
			
			$this->data['tmdsociallogin_fbsecretapi'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_twitapikey'])) {
			$this->data['tmdsociallogin_twitapikey'] = $this->request->post['tmdsociallogin_twitapikey'];
		} elseif ($this->config->get('tmdsociallogin_twitapikey')) {
			$this->data['tmdsociallogin_twitapikey'] = $this->config->get('tmdsociallogin_twitapikey');
		}
		else{
			
			$this->data['tmdsociallogin_twitapikey'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_twitsecretapi'])) {
			$this->data['tmdsociallogin_twitsecretapi'] = $this->request->post['tmdsociallogin_twitsecretapi'];
		} elseif ($this->config->get('tmdsociallogin_twitsecretapi')) {
			$this->data['tmdsociallogin_twitsecretapi'] = $this->config->get('tmdsociallogin_twitsecretapi');
		}
		else{
			
			$this->data['tmdsociallogin_twitsecretapi'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_gogleapikey'])) {
			$this->data['tmdsociallogin_gogleapikey'] = $this->request->post['tmdsociallogin_gogleapikey'];
		}  elseif ($this->config->get('tmdsociallogin_gogleapikey')) {
			$this->data['tmdsociallogin_gogleapikey'] = $this->config->get('tmdsociallogin_gogleapikey');
		}
		
		else{
			
			$this->data['tmdsociallogin_gogleapikey'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_gogelsecretapi'])) {
			$this->data['tmdsociallogin_gogelsecretapi'] = $this->request->post['tmdsociallogin_gogelsecretapi'];
		} elseif ($this->config->get('tmdsociallogin_gogelsecretapi')) {
			$this->data['tmdsociallogin_gogelsecretapi'] = $this->config->get('tmdsociallogin_gogelsecretapi');
		}
		else{
			
			$this->data['tmdsociallogin_gogelsecretapi'] ='';
		}
		if (isset($this->request->post['tmdsociallogin_linkdinapikey'])) {
			$this->data['tmdsociallogin_linkdinapikey'] = $this->request->post['tmdsociallogin_linkdinapikey'];
		}  elseif ($this->config->get('tmdsociallogin_linkdinapikey')) {
			$this->data['tmdsociallogin_linkdinapikey'] = $this->config->get('tmdsociallogin_linkdinapikey');
		}else{
			
			$this->data['tmdsociallogin_linkdinapikey'] ='';
		}
		
		if (isset($this->request->post['tmdsociallogin_linkdinsecretapi'])) {
			$this->data['tmdsociallogin_linkdinsecretapi'] = $this->request->post['tmdsociallogin_linkdinsecretapi'];
		}  elseif ($this->config->get('tmdsociallogin_linkdinsecretapi')) {
			$this->data['tmdsociallogin_linkdinsecretapi'] = $this->config->get('tmdsociallogin_linkdinsecretapi');
		}
			else{
			
			$this->data['tmdsociallogin_linkdinsecretapi'] ='';
		}	
		$this->load->model('tool/image');

		if (isset($this->request->post['tmdsociallogin_fbimage']) && is_file(DIR_IMAGE . $this->request->post['tmdsociallogin_fbimage'])) {
			$this->data['tmdsociallogin_fbthumb'] = $this->model_tool_image->resize($this->request->post['tmdsociallogin_fbimage'], 100, 100);
		} elseif (!empty($this->config->get('tmdsociallogin_fbimage')) && is_file(DIR_IMAGE . $this->config->get('tmdsociallogin_fbimage'))) {
			$this->data['tmdsociallogin_fbthumb'] = $this->model_tool_image->resize($this->config->get('tmdsociallogin_fbimage'), 100, 100);
		} else {
			$this->data['tmdsociallogin_fbthumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		
		if (isset($this->request->post['tmdsociallogin_twitimage']) && is_file(DIR_IMAGE . $this->request->post['tmdsociallogin_twitimage'])) {
			$this->data['tmdsociallogin_twiterthumb'] = $this->model_tool_image->resize($this->request->post['tmdsociallogin_twitimage'], 100, 100);
		} 
		elseif (!empty($this->config->get('tmdsociallogin_twitimage')) && is_file(DIR_IMAGE . $this->config->get('tmdsociallogin_twitimage'))) {
			$this->data['tmdsociallogin_twiterthumb'] = $this->model_tool_image->resize($this->config->get('tmdsociallogin_twitimage'), 100, 100);
		} 
		else {
			$this->data['tmdsociallogin_twiterthumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		if (isset($this->request->post['tmdsociallogin_gogleimage']) && is_file(DIR_IMAGE . $this->request->post['tmdsociallogin_gogleimage'])) {
			$this->data['tmdsociallogin_goglethumb'] = $this->model_tool_image->resize($this->request->post['tmdsociallogin_gogleimage'], 100, 100);
		} 
		elseif (!empty($this->config->get('tmdsociallogin_gogleimage')) && is_file(DIR_IMAGE . $this->config->get('tmdsociallogin_gogleimage'))) {
			$this->data['tmdsociallogin_goglethumb'] = $this->model_tool_image->resize($this->config->get('tmdsociallogin_gogleimage'), 100, 100);
		}
		else {
			$this->data['tmdsociallogin_goglethumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}


		if (isset($this->request->post['tmdsociallogin_linkdinimage']) && is_file(DIR_IMAGE . $this->request->post['linkdinimage'])) {
			$this->data['tmdsociallogin_linkdinthumb'] = $this->model_tool_image->resize($this->request->post['tmdsociallogin_linkdinimage'], 100, 100);
		} elseif (!empty($this->config->get('tmdsociallogin_linkdinimage')) && is_file(DIR_IMAGE . $this->config->get('tmdsociallogin_linkdinimage'))) {
			$this->data['tmdsociallogin_linkdinthumb'] = $this->model_tool_image->resize($this->config->get('tmdsociallogin_linkdinimage'), 100, 100);
		}
		 else {
			$this->data['tmdsociallogin_linkdinthumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['placeholder'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		
		$this->data['modules'] = array();

		if (isset($this->request->post['tmdsociallogin_module'])) {
			$this->data['modules'] = $this->request->post['tmdsociallogin_module'];
		} elseif ($this->config->get('tmdsociallogin_module')) { 
			$this->data['modules'] = $this->config->get('tmdsociallogin_module');
		}				

		
		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->template = 'module/tmdsociallogin.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());	 
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/tmdsociallogin')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		
		if(!empty($this->request->post['tmdsociallogin_fbstatus']) && $this->request->post['tmdsociallogin_fbstatus']==1) {
			
			if(empty($this->request->post['tmdsociallogin_fbapikey'])) {
				$this->error['tmdsociallogin_fbapikey'] = $this->language->get('error_fbapikey');
			}
				
			if(empty($this->request->post['tmdsociallogin_fbsecretapi'])) {
				$this->error['tmdsociallogin_fbsecretapi'] = $this->language->get('error_fbsecretapi');
			}
		
		}
		if(!empty($this->request->post['tmdsociallogin_twitstatus']) && $this->request->post['twitstatus']==1) {
			if(empty($this->request->post['tmdsociallogin_twitstatus'])) {
				$this->error['tmdsociallogin_twitstatus'] = $this->language->get('error_twitapikey');
			}
			
			if(empty($this->request->post['tmdsociallogin_twitsecretapi'])) {
				$this->error['tmdsociallogin_twitsecretapi'] = $this->language->get('error_twitsecret');
			}
		}
		if(!empty($this->request->post['tmdsociallogin_goglestatus']) && $this->request->post['tmdsociallogin_goglestatus']==1) {
			if(empty($this->request->post['tmdsociallogin_gogleapikey'])) {
				$this->error['tmdsociallogin_gogleapikey'] = $this->language->get('error_gogleapikey');
			}
			if(empty($this->request->post['tmdsociallogin_gogelsecretapi'])) {
				$this->error['tmdsociallogin_gogelsecretapi'] = $this->language->get('error_goglesecret');
			}
		}
		
		if(!empty($this->request->post['tmdsociallogin_linkstatus']) && $this->request->post['tmdsociallogin_linkstatus']==1) {
		if(empty($this->request->post['tmdsociallogin_linkdinapikey'])) {
			$this->error['tmdsociallogin_linkdinapikey'] = $this->language->get('error_linkdinapikey');
		}
		
		if(empty($this->request->post['tmdsociallogin_linkdinsecretapi'])) {
			$this->error['tmdsociallogin_linkdinsecretapi'] = $this->language->get('error_linkdinsecret');
		}
		}
		
		if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
	

		return !$this->error;
	}
}
