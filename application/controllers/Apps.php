<?php
if(!defined('BASEPATH'))exit('No direct access allowed');
class Apps extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('appscuti')!=1){
			$url = base_url().'login';
			redirect($url);
		}
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->library('pdf');
	}
	public function index(){
		$head['act'] = 1;
		$footer['footer'] = 'dash';
		$data['getdata'] = $this->m_cuti->getdata();
		$data['profileuser'] = $this->m_user->getdetailuser($this->session->userdata('iduser'))->row_array();
		$data['gettask'] = $this->m_cuti->gettask();
		$data['getriwayat'] = $this->m_cuti->getriwayat();
		$this->load->view('page/header',$head);
		$this->load->view('page/apps',$data);
		$this->load->view('page/footer',$footer);
	}

	public function cetakrep($jenis,$id){
		$data = $this->m_cuti->getdatadetailcuti($id);
		$ambil = $data['ambil']==1 ? 'Ambil Cuti' : 'Tidak diambil Cuti';
		$file = 'SuratCuti.pdf';
        $pdf = new FPDF_Protection('p','mm','A5');
        $pdf->SetProtection(array('print'), '');
		$pdf->AddFont('trebuchetb','B','TREBUCBD_1.php');
		$pdf->AddFont('trebuchet','','TREBUC_1.php');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('trebuchetb','B',16);
		$pdf->Cell(125,2,'SURAT PERMOHONAN '.strtoupper($data['keterangan']),0,1,'C');
		$pdf->Cell(10,4,'',0,1);
		$pdf->SetFont('trebuchet','',10);
		$pdf->Cell(125,2,'Berdasarkan Perjanjian Kerjabersama PT. Indoneptune Net Manufacturing',0,1,'C');
		$pdf->Cell(10,3,'',0,1);
		$pdf->Cell(125,2,'Pasal 24 Bab V',0,1,'C');
		$pdf->Line(10,25,135,25);
		$pdf->Line(74,25,74,152);
		$pdf->Line(10,40,135,40);
		$pdf->Line(10,152,135,152);
		$pdf->Line(10,176,135,176);
		$pdf->Line(10,180,135,180);
		$pdf->Cell(10,5,'',0,1);
		$pdf->Cell(65,2,')* No. ...............................');
		$pdf->Cell(65,2,'Kepada Yth');
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(65,2,'');
		$pdf->Cell(65,2,'Personel Manager');
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(65,2,'');
		$pdf->Cell(65,2,'PT. Indoneptune Net Manufacturing');
		$pdf->SetFont('trebuchet','',9);
		$pdf->Cell(10,8,'',0,1);
		$pdf->Cell(5,2,'1.');
		$pdf->Cell(62,2,'Nama');
		$pdf->Cell(3,2,'1.');
		$pdf->Cell(65,2,$data['nama']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'2.');
		$pdf->Cell(62,2,'No Induk');
		$pdf->Cell(3,2,'2.');
		$pdf->Cell(65,2,$data['noinduk']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'3.');
		$pdf->Cell(62,2,'Bagian');
		$pdf->Cell(3,2,'3.');
		$pdf->Cell(65,2,$data['bagian']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'4.');
		$pdf->Cell(62,2,'Jabatan');
		$pdf->Cell(3,2,'4.');
		$pdf->Cell(65,2,$data['jabatan']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'5.');
		$pdf->Cell(62,2,'Lama masa kerja didalam Perusahaan');
		$pdf->Cell(3,2,'5.');
		$pdf->Cell(65,2,'Masa kerja : '.umur($data['tglmasuk']));
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'terhitung selama masa percobaan');
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'Masuk kerja tanggal : '.tglpanjang($data['tglmasuk']));
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'6.');
		$pdf->Cell(62,2,'Permohonan untuk mengambil / tidak');
		$pdf->Cell(3,2,'6.');
		$pdf->Cell(65,2,'Diambil Cuti');
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,$ambil);
		$pdf->Cell(65,2,'');
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'7.');
		$pdf->Cell(62,2,'Permohonan ini diajukan untuk masa');
		$pdf->Cell(3,2,'7.');
		$pdf->Cell(65,2,$data['masakerja']);
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'kerja tahun ke');
		$pdf->Cell(65,2,'');
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'8.');
		$pdf->Cell(62,2,'Dari tanggal s/d tanggal');
		$pdf->Cell(3,2,'8.');
		$pdf->Cell(65,2,tglpanjang($data['dari']).' s/d '.tglpanjang($data['sampai']));
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'');
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'( '.selisihhari($data['dari'],$data['sampai']).' )');
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(5,2,'9.');
		$pdf->Cell(62,2,'Alasan yang jelas mengapa mengambil /');
		$pdf->Cell(3,2,'9.');
		$pdf->Cell(65,2,$data['alasan']);
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'tidak mengambil cuti');
		$pdf->Cell(65,2,'');
		$pdf->Cell(10,8,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'');
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'Bandung, '.tglpanjang(date('Y-m-d', strtotime($data['dibuat']))));
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'');
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'Pemohon');
		$pdf->Cell(10,15,'',0,1);
		$pdf->Cell(5,2,'');
		$pdf->Cell(62,2,'');
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'('.trim($data['nama']).')');
		$pdf->Cell(10,6,'',0,1);
		$pdf->Cell(44,2,'Menyetujui',0,0,'C');
		$pdf->Cell(44,2,'Menyetujui',0,0,'C');
		$pdf->Cell(44,2,'Menyetujui',0,0,'C');
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(44,2,'CHIEF OF LEADER',0,0,'C');
		$pdf->Cell(44,2,'SUPERVISOR',0,0,'C');
		$pdf->Cell(44,2,'PERSONEL MANAGER',0,0,'C');
		$pdf->Cell(10,15,'',0,1);
		$pdf->Cell(44,2,'(                         )',0,0,'C');
		$pdf->Cell(44,2,'(                         )',0,0,'C');
		$pdf->Cell(44,2,'(                         )',0,0,'C');
		$pdf->Cell(10,5,'',0,1);
		$pdf->Cell(65,2,'* Perhitungan :');
		$pdf->Cell(10,5,'',0,1);
		$pdf->SetFont('trebuchet','',8);
		$pdf->Cell(75,2,'* Diisi oleh personalia');
		$pdf->Cell(25,2,'Tembusan :');
		$pdf->Cell(40,2,'- Keamanan');
		$pdf->Cell(10,4,'',0,1);
		$pdf->Cell(75,2,'');
		$pdf->Cell(25,2,'');
		$pdf->Cell(40,2,'- Finance');
		$pdf->Output($file,'D');
	}

	public function logout(){
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
	}
}