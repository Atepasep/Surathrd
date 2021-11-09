<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Izin extends CI_Controller{
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
		$head['act'] = 3;
		$footer['footer'] = 'izin';
		$data['judul'] = 'Permohonan Izin Keluar, Pulang dan Terlambat';
		$data['formaction'] = base_url().'izin/simpanizin';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$this->load->view('page/header',$head);
		$this->load->view('page/izin',$data);
		$this->load->view('page/footer',$footer);
	}

	public function detizin(){
		$head['act'] = 3;
		$footer['footer'] = 'izin';
		$data['judul'] = 'Approve Izin Keluar, Pulang dan Terlambat';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['dataizin'] = $this->m_cuti->getdataizin();
		$this->load->view('page/header',$head);
		$this->load->view('page/detizin',$data);
		$this->load->view('page/footer',$footer);		
	}

	public function setjnsurat(){
		$jns = $_POST['jns'];
		$this->session->set_flashdata('jnssurat',$jns);
		echo '1';
	}

	public function simpanizin(){
		$this->m_cuti->simpanizin();
		redirect('izin');
	}

	public function isiapproveizin($id){
		$this->m_cuti->isiapproveizin($id);
		redirect('izin/detizin');
	}

	public function tolakizin($id){
		$data['id'] = $id;
		$this->load->view('page/tolakizin',$data);
	}
	public function tolakdatanya(){
		$id = $_POST['id'];
		$alasan = $_POST['alasn'];
		$hasil = $this->m_cuti->tolakdataizin($id,$alasan);
		echo $hasil;
	}
	public function approvesemuadata(){
		$this->m_cuti->approvesemuadataizin();
		redirect('izin/detizin');
	}
}