<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Konfirm extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_cuti');
		$this->load->model('m_konfirm');
		$this->load->model('m_user');
	}
	public function index(){
		$head['act'] = 1;
		$footer['footer'] = 'konfirm';
		$data['judul'] = 'Konfirmasi Izin';
		//$data['dataada'] = $this->m_cuti->gethistory();
		$this->session->set_flashdata('tglizin','');
		$this->load->view('page/header',$head);
		$this->load->view('page/konfirmizin',$data);
		$this->load->view('page/footer',$footer);
	}

	public function cekkonfirmizin(){
		$jenis = $_POST['jenis'];
		$id = $_POST['id'];
		$temp = $this->m_cuti->getdatadetailizin($id);
		$hasil = $this->m_konfirm->konfirmizin($temp['jnizin'],$id)->result_array();
		echo json_encode($hasil);
	}

	public function repizin(){
		$head['act'] = 1;
		$footer['footer'] = 'repkonfirm';
		$data['judul'] = 'Data Konfirmasi Surat Izin';
		$data['urltujuan'] = base_url().'konfirm/ubahtgl';
		if(!$this->session->flashdata('tglizin')){
			$this->session->set_flashdata('tglizin',date('d-m-Y'));
		}else{
			$this->session->set_flashdata('tglizin',$this->session->flashdata('tglizin'));
		}
		$data['datakonfirm'] = $this->m_konfirm->getdatakonfirm();
		$this->load->view('page/header',$head);
		$this->load->view('page/konfirmizinrep',$data);
		$this->load->view('page/footer',$footer);
	}

	public function ubahtgl(){
		$tgl = $_POST['tgl'];
		$this->session->set_flashdata('tglizin',$tgl);
		echo true;
	}

	public function kembali(){
		$this->session->set_flashdata('pesan','qrcodeberhasil');
		echo true;
	}
}