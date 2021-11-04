<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Spl extends CI_Controller{
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
		$head['act'] = 5;
		$footer['footer'] = 'absen';
		$data['judul'] = 'Surat Perintah Lembur';
		$this->load->view('page/header',$head);
		$this->load->view('page/spl',$data);
		$this->load->view('page/footer',$footer);
	}

}