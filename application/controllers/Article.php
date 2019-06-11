<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
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
	public function get_all()
	{
		return $this->response($this->article_model->get());
	}
	public function get($id)
	{
		return $this->response($this->article_model->get('id', $id));
	}
}
