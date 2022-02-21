<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Pengumuman extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_pengumuman');
	}
	public function index(){
		$head['act'] = 1;
		$footer['footer'] = 'pengumuman';
		$data['judul'] = 'Pengumuman';
		if(!$this->session->flashdata('tahsurat')){
			$this->session->set_flashdata('tahsurat',date('Y'));
		}else{
			$this->session->set_flashdata('tahsurat',$this->session->flashdata('tahsurat'));
		}
		if(!$this->session->flashdata('nodok')){
			$this->session->set_flashdata('nodok','x.pdf');
		}else{
			$this->session->set_flashdata('nodok',$this->session->flashdata('nodok'));
		}
		$data['pengumuman'] = $this->m_pengumuman->getdata();
		$this->cektahun($this->session->flashdata('tahsurat'));
		$this->load->view('page/header',$head);
		$this->load->view('page/pengumuman',$data);
		$this->load->view('page/footer',$footer);
	}

	public function ubahdok(){
		$tgl = $_POST['ses'];
		$oke = $_POST['ser'];
		$query = $this->m_pengumuman->getnodok($tgl,$oke)->row_array();
		$this->session->set_flashdata('nodok',$query['nodok']);
		echo true;
	}

	public function ubahtahun(){
		$tgl = $_POST['ses'];
		$this->session->set_flashdata('tahsurat',$tgl);
		$this->session->set_flashdata('nodok','');
		echo true;
	}

	public function cektahun($th){
		$this->m_pengumuman->cektahun($th);
	}

	public function cleardata(){
		$this->session->set_flashdata('tahsurat','');
		$this->session->set_flashdata('nodok','');
		redirect('pengumuman');
	}

}