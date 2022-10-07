<?php
if (!defined('BASEPATH')) exit('No direct access allowed');
class Profile extends CI_Controller
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
		$head['act'] = 8;
		$footer['footer'] = 'user';
		$data['judul'] = 'Profile';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['formaction'] = base_url() . 'Profile/simpanfoto';
		$this->session->set_flashdata('periodekk', '');
		$this->load->view('page/header', $head);
		$this->load->view('page/profile', $data);
		$this->load->view('page/footer', $footer);
	}
	public function keluarga()
	{
		$head['act'] = 8;
		$footer['footer'] = 'user';
		$data['judul'] = '<a href="' . base_url('profile') . '">Profile</a> - Data Keluarga';
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['formaction'] = base_url() . 'Profile/simpanfoto';
		if ($this->session->flashdata('periodekk') == '') {
			$this->session->set_flashdata('periodekk', date('Y'));
		} else {
			$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		}
		$data['keluarga'] = $this->m_user->getdatakeluarga();
		$cek = $this->m_user->getkkkeluarga();
		if ($cek->num_rows() > 0) {
			$data['kk'] = $cek->row_array();
		} else {
			$data['kk'] = null;
		}
		$this->load->view('page/header', $head);
		$this->load->view('page/keluarga', $data);
		$this->load->view('page/footer', $footer);
	}
	public function addkeluarga()
	{
		$data['id'] = null;
		$data['nik'] = null;
		$data['nama'] = null;
		$data['jenkel'] = null;
		$data['tmplahir'] = null;
		$data['tgllahir'] = null;
		$data['id_pendidikan'] = null;
		$data['pekerjaan'] = null;
		$data['id_statuskawin'] = null;
		$data['id_hubkeluarga'] = null;
		$data['noinduk'] = null;
		$data['status'] = $this->m_user->getstatusnikah();
		$data['pendidikan'] = $this->m_user->getpendidikan();
		$data['hubkeluarga'] = $this->m_user->gethubkeluarga();
		$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		$data['formAction'] = base_url() . 'Profile/simpankeluarga';
		$this->load->view('page/addkeluarga', $data);
	}
	public function editkeluarga($id)
	{
		$temp = $this->m_user->getdatakeluarga_detail($id)->row_array();
		$data['id'] = $temp['id'];
		$data['nik'] = $temp['nik'];
		$data['nama'] = $temp['nama'];
		$data['jenkel'] = $temp['jenkel'];
		$data['tmplahir'] = $temp['tmplahir'];
		$data['tgllahir'] = tglmysql($temp['tgllahir']);
		$data['id_pendidikan'] = $temp['id_pendidikan'];
		$data['pekerjaan'] = $temp['pekerjaan'];
		$data['id_statuskawin'] = $temp['id_statuskawin'];
		$data['id_hubkeluarga'] = $temp['id_hubkeluarga'];
		$data['noinduk'] = $temp['noinduk'];
		$data['status'] = $this->m_user->getstatusnikah();
		$data['pendidikan'] = $this->m_user->getpendidikan();
		$data['hubkeluarga'] = $this->m_user->gethubkeluarga();
		$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		$data['formAction'] = base_url() . 'Profile/updatekeluarga';
		$this->load->view('page/addkeluarga', $data);
	}
	public function hapuskeluarga($id)
	{
		$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		$hasil = $this->m_user->hapuskeluarga($id);
		if ($hasil) {
			redirect('profile/keluarga');
		}
	}
	public function validasikeluarga()
	{
		$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		$hasil = $this->m_user->validasikeluarga();
		if ($hasil) {
			redirect('profile/keluarga');
		}
	}
	public function ubahperiode()
	{
		$periode = $_POST['period'];
		$hasil = $this->session->set_flashdata('periodekk', $periode);
		echo 1;
	}
	public function ubahidkey()
	{
		$this->load->view('page/ubahidkey');
	}
	public function ubahnohp()
	{
		$this->load->view('page/ubahnohp');
	}
	public function updateidkey()
	{
		$key = strtoupper($_POST['idkey']);
		$hasil = $this->m_user->updateidkey($key)->result();
		echo json_encode($hasil);
	}
	public function updatenohp()
	{
		$key = strtoupper($_POST['idkey']);
		$hasil = $this->m_user->updatenohp($key)->result();
		echo json_encode($hasil);
	}
	public function cekidkey()
	{
		$key = strtoupper($_POST['idkey']);
		$hasil = $this->m_user->cekidkey($key)->result();
		echo json_encode($hasil);
	}

	public function simpanfoto()
	{
		$this->m_user->simpanfotoprofile();
		redirect('profile');
	}

	public function simpankeluarga()
	{
		$this->m_user->simpankeluarga();
		redirect('profile/keluarga');
	}
	public function updatekeluarga()
	{
		$this->m_user->updatekeluarga();
		redirect('profile/keluarga');
	}
	public function updatekk()
	{
		$this->session->set_flashdata('periodekk', $this->session->flashdata('periodekk'));
		$nokk = $_POST['nokk'];
		$this->m_user->updatekk($nokk);
		echo 1;
	}
}
