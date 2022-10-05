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
		$this->load->model('m_user');
	}
	public function index()
	{
		$head['act'] = 11;
		$footer['footer'] = 'valid';
		$data['judul'] = 'Validator Departemen';
		$data['databag'] = $this->m_user->getvalidator();
		$this->load->view('page/header', $head);
		$this->load->view('page/validator', $data);
		$this->load->view('page/footer', $footer);
	}
	public function tospv()
	{
		$data = $_POST['dt'];
		if ($data == '1') {
			$this->session->set_userdata('modespv', 1);
		} else {
			unset($_SESSION['modespv']);
		}
		$url = base_url() . 'validator';
		redirect($url);
	}
	public function cekvalid()
	{
		$bag = $_POST['bag'];
		$grp = $_POST['grp'];
		$lid = $_POST['lid'];

		$hasil = $this->m_user->getnikvalidator($bag, $grp, $lid)->result();
		echo json_encode($hasil);
	}
}
