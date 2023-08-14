<?php
namespace Opencart\Catalog\Controller\Extension\Tmdsociallogin\Tmd;
class Socialaccountlogin extends \Opencart\System\Engine\Controller {
	public function accountlogin(string &$route, array &$args, mixed &$output): void {
		$modulestatus=$this->config->get('status');
		$args['column_login'] = $this->load->controller('extension/tmdsociallogin/tmd/column_login');
		
		$template_buffer = $this->getTemplateBuffer($route,$output);
		$find='<button type="submit" class="btn btn-primary">{{ button_login }}</button>';
		$replace='<button type="submit" class="btn btn-primary pull-left">{{ button_login }}</button> {{ column_login }}';
		$output = str_replace( $find, $replace, $template_buffer );
		
	
		$find='{{ footer }}';
		$replace=file_get_contents(DIR_EXTENSION.'tmdsociallogin/catalog/view/template/tmd/socialaccountlogin.twig').'{{ footer }}';
		$output = str_replace( $find, $replace, $output );	 
	}
	
	public function checkout(string &$route, array &$args, mixed &$output): void {
		$modulestatus=$this->config->get('status');
		$args['column_login'] = $this->load->controller('extension/tmdsociallogin/tmd/column_login');
		
		$template_buffer = $this->getTemplateBuffer($route,$output);
		$find='{% if shipping_method %}';
		$replace='{{ column_login }} {% if shipping_method %}';
		$output = str_replace( $find, $replace, $template_buffer );
		
		$find='{{ footer }}';
		$replace=file_get_contents(DIR_EXTENSION.'tmdsociallogin/catalog/view/template/tmd/socialaccountlogin.twig').'{{ footer }}';
		$output = str_replace( $find, $replace, $output );
	}
	
	protected function getTemplateBuffer( $route, $event_template_buffer ) {
		// if there already is a modified template from view/*/before events use that one
		if ($event_template_buffer) {
			return $event_template_buffer;
		}

		// load the template file (possibly modified by ocmod and vqmod) into a string buffer
		
			if ($this->config->get('config_theme') == 'default') {
				$theme = $this->config->get('theme_default_directory');
			} else {
				$theme = $this->config->get('config_theme');
			}
			  $dir_template = DIR_TEMPLATE ;
			
		
	 $template_file = $dir_template . $route . '.twig';
		if (file_exists( $template_file ) && is_file( $template_file )) {
			
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
}
