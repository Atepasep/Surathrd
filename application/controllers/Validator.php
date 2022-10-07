<?php
if (!defined('BASEPATH')) exit('No direct access allowed');
class Validator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('appscuti') != 1) {
			$url = base_url() . 'login';
			redirect($url);
		}
		$this->load->model('m_validator');
		$this->load->model('m_user');
	}
	public function index()
	{
		$head['act'] = 11;
		$footer['footer'] = 'valid';
		$data['judul'] = 'Data Validator  & Releaser Karyawan';
		$data['datakaryawan'] = $this->m_validator->getdata();
		$data['databagian'] = $this->m_validator->getbagianmperson();
		if ($this->session->userdata('bagianvalidator') == '') {
			$this->session->set_userdata('bagianvalidator', '');
			$this->session->set_userdata('grpvalidator', '');
		}
		$data['datagrp'] = $this->m_validator->getgrpmperson();
		$this->load->view('page/header', $head);
		$this->load->view('page/validator', $data);
		$this->load->view('page/footer', $footer);
	}

	public function clear()
	{
		$this->session->unset_userdata('bagianvalidator');
		$this->session->unset_userdata('grpvalidator');
		$url = base_url() . 'validator';
		redirect($url);
	}

	public function getdata()
	{
		$bag = $_POST['bg'];
		$grp = $_POST['gr'];
		$this->session->set_userdata('bagianvalidator', $bag);
		$this->session->set_userdata('grpvalidator', $grp);
		return true;
	}
	public function getvalid()
	{
		$kritper = $_POST['kritper'];
		$data = $this->m_validator->getdatavalid($kritper);
		echo json_encode($data->row_array());
	}
	public function addvalid($xdata = 0)
	{
		$data['datavalid'] = $this->m_validator->getdatavalidator();
		$temp = $this->m_user->getdatauserkrit($xdata)->row_array();
		$data['current'] = $temp['valid'];
		$data['dataasli'] = $xdata;
		$this->load->view('page/addvalidator', $data);
	}
	public function addrilis($xdata = 0)
	{
		$data['datavalid'] = $this->m_validator->getdatavalidator();
		$temp = $this->m_user->getdatauserkrit($xdata)->row_array();
		$data['current'] = $temp['rilis'];
		$data['dataasli'] = $xdata;
		$this->load->view('page/addreleaser', $data);
	}
	public function simpanvalid()
	{
		$id = $_POST['id'];
		$isi = $_POST['isi'];
		$hasil = $this->m_validator->simpanvalid($id, $isi)->result();
		echo json_encode($hasil);
	}
	public function delvalid($isi)
	{
		$query = $this->m_validator->delvalid($isi);
		if ($query) {
			$url = base_url() . 'validator';
			redirect($url);
		}
	}
	public function simpanrilis()
	{
		$id = $_POST['id'];
		$isi = $_POST['isi'];
		$hasil = $this->m_validator->simpanrilis($id, $isi)->result();
		echo json_encode($hasil);
	}
	public function delrilis($isi)
	{
		$query = $this->m_validator->delrilis($isi);
		if ($query) {
			$url = base_url() . 'validator';
			redirect($url);
		}
	}
}
