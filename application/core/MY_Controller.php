<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $master_layout;

	public function __construct(){
		parent::__construct();
		$this->master_layout = 'layout/admin-master';
	}
}