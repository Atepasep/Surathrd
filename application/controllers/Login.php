<?php if(!defined('BASEPATH'))exit ('No direct acccess allowed');
class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->load->model('m_login');
	}

	public function index(){
		$data['formaction'] = base_url().'Login/cek_login';
		$this->load->view('login',$data);
	}

	public function cek_login(){
		$user = strtoupper($this->input->post('idkey',True));
		// $pass = strtoupper($this->input->post('password',True));
		$ceklogin = $this->m_login->cek_login($user);
		if($ceklogin->num_rows() == 1){
			$this->session->set_flashdata('info','Berhasillogin');
			$data = $ceklogin->row_array();
			$this->session->set_userdata('iduser',$data['idkey']);
			$this->session->set_userdata('noinduk',$data['noinduk']);
			$this->session->set_userdata('bagian',trim($data['bagian']));
			$this->session->set_userdata('id_jabatan',$data['id_jabatan']);
			$this->session->set_userdata('lastlogin',$data['lastlogin']);
			$this->session->set_userdata('hakdep',gethakdep($data['hakdep']));
			$this->session->set_userdata('hakgrp',gethakgrp($data['hakgrp']));
			$this->session->set_userdata('grp',$data['grp']);
			$this->session->set_userdata('kel',$data['jenkel']);
			$this->session->set_userdata('kritper',$data['kritkar'].$data['person_id']);
			$this->session->set_userdata('appscuti',1);
			$this->m_login->inputlogin($data['idkey']);
			$this->loginberhasil();
		}else{
			$this->session->set_flashdata('info','logingagal');
			$url = base_url().'Login';
			redirect($url);
		}
	}

	public function loginberhasil(){
		$url = base_url();
		redirect($url);
	}
}
