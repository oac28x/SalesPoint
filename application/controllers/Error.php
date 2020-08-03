<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {	

	function __Construct(){
		parent::__Construct();
	}
	public function index()
	{			
		$this->load->view('errors/error404');	
	}
	public function mandaDatos_vista()
	{			
		$Data=array(
			'titulo'=>"Hay error | 404"
		);		
		$this->load->view('head', $Data);	
		$this->load->view('errors/html/error_404_2');	
		$this->load->view('pata');
	}
}
