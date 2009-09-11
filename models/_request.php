<?php

class onetwoAll_request {
	private $_snoopy;
	private $_api_user = 			ONETWOALL_API_USER;
	private $_api_pass = 			ONETWOALL_API_PASS;
	private $_api_url = 			ONETWOALL_API_URL;
	
	private $_api_action;
	private $_api_output = 			'serialize';
	
	private $_additional_params = 	array();
	private $_post = 				array();
	
	public function __construct() {
		require_once(ONETWOALL_COMPONENT_PATH.DS.'libraries'.DS.'Snoopy'.DS.'Snoopy.class.php');
		$this->_snoopy = new Snoopy();
		
		$this->_additional_params = array();
		$this->_post = array();
	}
	
	private function _snoopy() {
		return $this->_snoopy;
	}
	
	private function _api_user() {
		return $this->_api_user;
	}
	
	private function _api_pass() {
		return $this->_api_pass;
	}
	
	private function _api_output() {
		return $this->_api_output;
	}
	
	public function api_action() {
		return $this->_api_action;
	}
	
	public function api_url() {
		return $this->_api_url;
	}
	
	public function set_api_action($action) {
		$this->_api_action = $action;
	}
	
	public function add_parameter($key, $value) {
		if (!$key || !$value) {
			return false;
		}
		
		return $this->_additional_params[$key] = $value;
	}
	
	public function add_post_parameter($key, $value) {
		if (!$key || !$value) {
			return false;
		}
		
		return $this->_post_params[$key] = (string)$value;
	}
	
	public function post_params() {
		return $this->_post_params;
	}
	
	public function additional_params() {
		return $this->_additional_params;
	}
	
	public function get_params() {
		$params['api_user'] = $this->_api_user();
		$params['api_pass'] = $this->_api_pass();
		$params['api_output'] = $this->_api_output();
		$params['api_action'] = $this->api_action();
		$params = array_merge($params, $this->additional_params());
		return $params;
	}
	
	public function get_params_as_string() {
		$string = '';
		$params = $this->get_params();
		foreach ($params as $key => $value) {
			$params[$key] = "$key=$value";
		}
		return implode('&', $params);
	}
	
	public function request() {
		$snoopy = $this->_snoopy();
		$params = $this->get_params_as_string();
		$post_params = $this->post_params();
		$url = "{$this->api_url()}?$params";
		
		if (count($post_params) > 0) {
			$snoopy->submit($url, $post_params);
		} else {
			$snoopy->fetch($url);
		}
		
		$result = $snoopy->results;
		$result = unserialize($result);
		
		if (!$result['result_code']) {
			throw new Exception($result['result_message'], $result['result_code']);
		} else {
			unset($result['result_code']);
			unset($result['result_message']);
			unset($result['result_output']);
		}
		
		
		return $result;
	}
}

?>