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

		// ==== ALLOWING CORS 
		header('Acces-Control-Allow-Origin: *');
		header('Acces-Control-Allow-Methods: GET, PUT, POST, DELET, OPTIONS');
		header('Acces-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
	}
	public function response($data, $status)
	{
		$this->output
			 ->set_status_header($status)
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
			], 204);
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
			return $decoded->id;
		} catch(\Exception $e) {
			return $this->response([
				'success' 	=> false,
				'message'	=> 'gagal mengakses token'
			], 404);
		}
	}
	public function delete($id)
	{
		if ($id_user = $this->check_token()) {
			if ($id_user == $id) {
				return $this->response($this->user_model->delete($id));
			}else{
				return $this->response([
					'success' 	=> false,
					'message'	=> 'gagal delete user'
				], 403);
			}
		}
	}
}
