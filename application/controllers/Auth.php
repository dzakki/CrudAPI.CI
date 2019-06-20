<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'/Libraries/JWT.php';
use \Firebase\JWT\JWT;

class Auth extends CI_Controller {
	private $secret = 'ini adalah key rahasia';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	public function response($data)
	{
		$this->output
			 ->set_status_header(200)
			 ->set_content_type('application/json','utf-8')
			 ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ))
			 ->_display();
		exit;
	}
	public function login()
	{
		$date = new DateTime();
		if (!$this->user_model->is_valid()) {
			return $this->response([
				'success' 	=> false,
				'message'	=> 'username atau password salah'
			]);
		}
		$user = $this->user_model->get('username', $this->input->post('username'));
		$payload['id'] 		 = $user->id_user;
		$payload['iat']		 = $date->getTimestamp();
		$payload['exp']		 = $date->getTimestamp() + 60*60*2;

		$output['id_token'] = JWT::encode($payload, $this->secret);
		$this->response($output);
	}
	public function check_token()
	{
		$jwt = $this->input->get_request_header('Authorization');
		try{
			$decoded = JWT::decode($jwt, $this->secret, array('HS256'));
			var_dump($decoded);
		} catch(\Exception $e) {
			return $this->response([
				'success' 	=> false,
				'message'	=> 'gagal mengakses token'
			]);
		}
	}
}
