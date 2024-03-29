<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once APPATH .'Libraries/JWT.php';
// use \Firebase\JWT\JWT;

class Article extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_model');
		
		header('Acces-Control-Allow-Origin: *');
		header('Acces-Control-Allow-Methods: GET, PUT, POST, DELET, OPTIONS');
		header('Acces-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
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
	public function create()
	{
		return $this->response($this->article_model->create());	
	}
	public function update($id)
	{
		return $this->response($this->article_model->update('id', $id));
	}
	public function delete($id)
	{
		return $this->response($this->article_model->delete('id', $id));
	}
}
