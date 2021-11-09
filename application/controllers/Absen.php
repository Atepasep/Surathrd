<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Absen extends CI_Controller{
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
		$head['act'] = 4;
		$footer['footer'] = 'absen';
		$data['judul'] = 'Keterangan tidak Masuk Kerja';
		$data['formaction'] = base_url().'absen/simpanabsen';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$this->load->view('page/header',$head);
		$this->load->view('page/absen',$data);
		$this->load->view('page/footer',$footer);
	}

	public function detabsen(){
		$head['act'] = 4;
		$footer['footer'] = 'absen';
		$data['judul'] = 'Approve Absen (Keterangan tidak Masuk Kerja)';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['dataabsen'] = $this->m_absen->getdataabsen();
		$this->load->view('page/header',$head);
		$this->load->view('page/detabsen',$data);
		$this->load->view('page/footer',$footer);		
	}


	public function setjnsurat(){
		$jns = $_POST['jns'];
		$this->session->set_flashdata('jnssurat',$jns);
		echo '1';
	}

	public function simpanabsen(){
		$this->m_absen->simpanabsen();
		redirect('absen');
	}

	public function isiapproveabsen($id){
		$this->m_absen->isiapproveabsen($id);
		redirect('absen/detabsen');
	}

	public function tolakabsen($id){
		$data['id'] = $id;
		$this->load->view('page/tolakabsen',$data);
	}
	public function tolakdatanya(){
		$id = $_POST['id'];
		$alasan = $_POST['alasn'];
		$hasil = $this->m_absen->tolakdataabsen($id,$alasan);
		echo $hasil;
	}
	public function approvesemuadata(){
		$this->m_absen->approvesemuadataabsen();
		redirect('absen/detabsen');
	}
}