<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arden extends MY_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$wew = count(Employees_model::find('all'));
		echo '<pre>';
		var_dump($wew);
	}
}