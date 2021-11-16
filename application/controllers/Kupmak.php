<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Kupmak extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_absen');
		$this->load->model('m_user');
	}
	public function index(){
		$head['act'] = 7;
		$footer['footer'] = 'absen';
		$data['judul'] = 'Input Kupon Makan';
		$this->load->view('page/header',$head);
		$this->load->view('page/kupmak',$data);
		$this->load->view('page/footer',$footer);
	}

}