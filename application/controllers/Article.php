<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function get_all()
	{
		echo 'get_all';
	}
	public function get($id)
	{
		echo 'get_id'.$id;
	}
}
