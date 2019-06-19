<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
			 ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			 ->_display();
		exit;
	}
	public function create()
	{
	 	$this->response($this->user_model->create());
	}
	public function update($id)
	{
		$this->response($this->user_model->update('id_user', $id));
	}
	public function get_all()
	{
		$this->response($this->user_model->get());
	}
	public function get($id)
	{
		$this->response($this->user_model->get('id_user', $id));
	}
	public function delete($id)
	{
		$this->response([null]);
	}

}
