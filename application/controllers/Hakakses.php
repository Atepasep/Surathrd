<?php
if (!defined('BASEPATH')) exit('No direct access allowed');
class Hakakses extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('appscuti') != 1) {
			$url = base_url() . 'login';
			redirect($url);
		}
		$this->load->model('m_absen');
		$this->load->model('m_user');
	}
	public function index()
	{
		$head['act'] = 6;
		$footer['footer'] = 'akses';
		$data['judul'] = 'Hak Akses Departemen';
		$data['datauser'] = $this->m_user->getuser();
		$data['bagian'] = $this->m_user->getbagian();
		$data['group'] = $this->m_user->getgroup();
		$this->load->view('page/header', $head);
		$this->load->view('page/hakakses', $data);
		$this->load->view('page/footer', $footer);
	}
	public function editakses()
	{
		$data = $_POST['ses'];
		$nik = $_POST['nik'];
		$hasil = $this->m_user->editakses($nik)->result();
		echo json_encode($hasil);
	}
	public function getdetailuser()
	{
		$idkey = $_POST['idkey'];
		$hasil = $this->m_user->getdetailuser($idkey, 1)->result();
		echo json_encode($hasil);
	}
	public function gethakuser()
	{
		$idkey = $_POST['noin'];
		$hasil = $this->m_user->getdatauser($idkey, 1)->result();
		echo json_encode($hasil);
	}
	public function editakses2()
	{
		$noin = $_POST['noin'];
		$ke = $_POST['ke'];
		$hasil = $this->m_user->editakses2($noin, $ke);
		echo $hasil;
	}
	public function editaksesgrp()
	{
		$noin = $_POST['noin'];
		$ke = $_POST['ke'];
		$hasil = $this->m_user->editaksesgrp($noin, $ke);
		echo $hasil;
	}
}
