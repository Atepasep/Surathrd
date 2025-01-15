<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Presensi extends CI_Controller{
    public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('appscuti') != 1) {
			$url = base_url() . 'login';
			redirect($url);
		}
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_absen');
		$this->load->model('m_presensi','presensimodel');
	}
    public function index()
	{
		$head['act'] = 12;
		$footer['footer'] = 'presensi';
		$data['judul'] = 'Presensi Karyawan';
		$data['formaction'] = base_url() . 'cuti/simpancuti';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['data'] = $this->presensimodel->getdatapresensi();
		if($this->session->userdata('blpresensi')==''){
			$this->session->set_userdata('blpresensi',date('m'));
			$this->session->set_userdata('thpresensi',date('Y'));
		}
		$this->load->view('page/header', $head);
		$this->load->view('page/presensi', $data);
		$this->load->view('page/footer', $footer);
	}
	public function tambahpresensi(){
		$data = [
			'kritkar' => substr($this->session->userdata('kritper'),0,1),
			'person_id' => substr($this->session->userdata('kritper'),1,15),
			'tgl' => $_POST['tgl'],
			'jam' => $_POST['jam'],
			'jenis' => $_POST['jenis'],
			'lokasi' => $_POST['lokasi'],
			'jarak' => $_POST['jarak']
		];
		$hasil = $this->presensimodel->tambahpresensi($data);
		if($hasil){
			$this->session->set_flashdata('pesanpresensi','berhasilpresensi');
			echo $hasil;
		}
	}
	public function clear(){
		$this->session->unset_userdata('blpresensi');
		$this->session->unset_userdata('thpresensi');
		$url = base_url().'presensi';
		redirect($url);
	}
	public function ubahperiode(){
		$this->session->set_userdata('blpresensi',$_POST['blpresensi']);
		$this->session->set_userdata('thpresensi',$_POST['thpresensi']);
		$url = base_url().'presensi';
		redirect($url);
	}
}