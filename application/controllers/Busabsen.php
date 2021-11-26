<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Busabsen extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_busabsen');
		$this->load->model('m_user');
	}
	public function index(){
		$head['act'] = 9;
		$footer['footer'] = 'busabsen';
		$data['judul'] = 'Absen Bus Jemputan';
		if(!$this->session->flashdata('tglabsen')){
			$this->session->set_flashdata('tglabsen',date('d-m-Y'));
		}else{
			$this->session->set_flashdata('tglabsen',$this->session->flashdata('tglabsen'));
		}
		$data['dataabsen'] = $this->m_busabsen->getdata();;
		$this->load->view('page/header',$head);
		$this->load->view('page/busabsen',$data);
		$this->load->view('page/footer',$footer);
	}

	public function ubahtglabsen(){
		$tgl = $_POST['tgl'];
		$this->session->set_flashdata('tglabsen',$tgl);
		echo true;
	}

	public function addabsenbus(){
		$this->session->set_flashdata('tglabsen',$this->session->flashdata('tglabsen'));
		$data['shift'] = $this->m_busabsen->getdatashifttgl();
		$data['jemput'] = $this->m_busabsen->getdatajemputkar();
		$this->load->view('page/addabsenbus',$data);
	}
	public function editabsen($id){
		$this->session->set_flashdata('tglabsen',$this->session->flashdata('tglabsen'));
		$data['absenbus'] = $this->m_busabsen->getdatadetail($id)->row_array();
		$this->load->view('page/editabsenbus',$data);
	}

	public function adddata(){
		$this->session->set_flashdata('tglabsen',$this->session->flashdata('tglabsen'));
		$idbus = $_POST['idbus'];
		$kodeshif = $_POST['kodeshift'];
		$masuk = $_POST['masuk'];
		$pulang = $_POST['pulang'];
		$tgl = $this->session->flashdata('tglabsen');
		$query = $this->m_busabsen->adddata($tgl, $idbus,$kodeshif,$masuk,$pulang);
		echo $query;
	}
	public function editdata(){
		$this->session->set_flashdata('tglabsen',$this->session->flashdata('tglabsen'));
		$id = $_POST['id'];
		$masuk = $_POST['masuk'];
		$pulang = $_POST['pulang'];
		$query = $this->m_busabsen->editdata($id,$masuk,$pulang);
		echo $query;
	}
}