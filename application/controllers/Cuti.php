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
		$data['jncuti'] =null;
		$data['tgldibuat'] = null;
		$data['ambil'] = null;
		$data['dari'] = null;
		$data['sampai'] = null;
		$data['jmhari']= null;
		$data['masakerja'] = null;
		$data['alasan'] = null;
		$data['xalasan'] = null;
		$data['tglik'] = null;
		$data['hariik'] = null;
		$data['jamik'] = null;
		$data['tempatik'] = null;
		$data['idx'] = null;
		$data['kode'] = 'Simpan';
		$data['jeniscuti'] = $this->m_user->getjeniscuti(0);
		$this->load->view('page/header',$head);
		$this->load->view('page/cuti',$data);
		$this->load->view('page/footer',$footer);
	}
	public function editcuti($id){
		$head['act'] = 2;
		$footer['footer'] = 'cuti';
		$data['judul'] = 'Permohonan cuti dan Izin Khusus';
		$data['formaction'] = base_url().'cuti/updatecuti';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$temp = $this->m_cuti->getdatadetailcuti($id);
		$data['jncuti'] = $temp['jncuti'];
		$data['tgldibuat'] = $temp['dibuat'];
		$data['ambil'] = $temp['ambil'];
		$data['dari'] = tglmysql($temp['dari']);
		$data['sampai'] = tglmysql($temp['sampai']);
		$data['jmhari']= $temp['lama'];
		$data['masakerja'] = $temp['masakerja'];
		$data['alasan'] = $temp['alasan'];
		$data['xalasan'] = $temp['alasan'];
		$data['tglik'] = tglmysql($temp['tgl_khusus']);
		$data['hariik'] = $temp['hari'];
		$data['jamik'] = $temp['jam'];
		$data['tempatik'] = $temp['tempat'];
		$data['idx'] = $temp['id'];
		$data['kode'] = 'Update';
		$data['jeniscuti'] = $this->m_user->getjeniscuti(0);
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
			case 'absen':
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
			case 'absen':
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

	public function updatecuti(){
		$this->m_cuti->updatecuti();
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