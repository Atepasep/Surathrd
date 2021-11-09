<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Cuti extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_absen');
	}
	public function index(){
		$head['act'] = 2;
		$footer['footer'] = 'cuti';
		$data['judul'] = 'Permohonan cuti dan Izin Khusus';
		$data['formaction'] = base_url().'cuti/simpancuti';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$this->load->view('page/header',$head);
		$this->load->view('page/cuti',$data);
		$this->load->view('page/footer',$footer);
	}
	public function detcuti(){
		$head['act'] = 2;
		$footer['footer'] = 'cuti';
		$data['judul'] = 'Approve cuti dan Izin Khusus';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['datacuti'] = $this->m_cuti->getdatacuti();
		$data['depcuti'] = $this->m_cuti->getdepcuti();
		$this->load->view('page/header',$head);
		$this->load->view('page/detcuti',$data);
		$this->load->view('page/footer',$footer);		
	}

	public function viewdata($tabel,$id){
		switch ($tabel) {
			case 'ketabsen':
				$data['getdata'] = $this->m_absen->getdatadetailabsen($id);
				break;
			case 'cuti':
				$data['getdata'] = $this->m_cuti->getdatadetailcuti($id);
				break;
			case 'izin':
				$data['getdata'] = $this->m_cuti->getdatadetailizin($id);
				break;
		}
		$data['mode'] = $tabel;
		$this->load->view('page/detailpermohonan',$data);
	}

	public function hapusdata($tabel,$id){
		switch ($tabel) {
			case 'ketabsen':
				$data['getdata'] = $this->m_absen->hapusdata($id);
				break;
			case 'cuti':
				$data['getdata'] = $this->m_cuti->hapusdatacuti($id);
				break;
			case 'izin':
				$data['getdata'] = $this->m_cuti->hapusdataizin($id);
				break;
		}
		redirect('apps');
	}

	public function simpancuti(){
		$this->m_cuti->simpancuti();
		redirect('cuti');
	}

	public function isiapprove($id){
		$this->m_cuti->isiapprove($id);
		redirect('cuti/detcuti');
	}

	public function tolakcuti($id){
		$data['id'] = $id;
		$this->load->view('page/tolakdata',$data);
	}
	public function tolakdatanya(){
		$id = $_POST['id'];
		$alasan = $_POST['alasn'];
		$hasil = $this->m_cuti->tolakdata($id,$alasan);
		echo $hasil;
	}
	public function approvesemuadata(){
		$this->m_cuti->approvesemuadatacuti();
		redirect('cuti/detcuti');
	}
}