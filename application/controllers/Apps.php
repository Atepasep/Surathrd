<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Apps extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_cuti');
		$this->load->model('m_user');
	}
	public function index(){
		$head['act'] = 1;
		$footer['footer'] = 'dash';
		$data['getdata'] = $this->m_cuti->getdata();
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'));
		$data['gettask'] = $this->m_cuti->gettask();
		$data['getriwayat'] = $this->m_cuti->getriwayat();
		$this->load->view('page/header',$head);
		$this->load->view('page/apps',$data);
		$this->load->view('page/footer',$footer);
	}

	public function logout(){
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
	}
}