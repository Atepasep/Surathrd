<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Slip extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
	}
	public function index(){
		$head['act'] = 10;
		$footer['footer'] = 'slip';
		$data['judul'] = 'Slip Gaji';
		$this->load->view('page/header',$head);
		$this->load->view('page/slip',$data);
		$this->load->view('page/footer',$footer);
	}

}