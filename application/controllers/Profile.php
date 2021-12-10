<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Profile extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_user');
	}
	public function index(){
		$head['act'] = 8;
		$footer['footer'] = 'user';
		$data['judul'] = 'Profile';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['formaction'] = base_url().'Profile/simpanfoto';
		$this->load->view('page/header',$head);
		$this->load->view('page/profile',$data);
		$this->load->view('page/footer',$footer);
	}
	public function ubahidkey(){
		$this->load->view('page/ubahidkey');
	}
	public function updateidkey(){
		$key = strtoupper($_POST['idkey']);
		$hasil = $this->m_user->updateidkey($key)->result();
		echo json_encode($hasil);
	}
	public function cekidkey(){
		$key = strtoupper($_POST['idkey']);
		$hasil = $this->m_user->cekidkey($key)->result();
		echo json_encode($hasil);
	}

	public function simpanfoto(){
		$this->m_user->simpanfotoprofile();
		redirect('profile');
	}
}