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
		$this->load->library('Qr');
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

	public function cetakform($jenis,$id){
		$data = $this->m_cuti->getdatadetailizin($id);
		$file = 'Suratizin.pdf';
        $pdf = new FPDF_Protection('p','mm','A4');
        $pdf->SetProtection(array('print'), '');
		$pdf->AddPage();
		$pdf->AddFont('couriernew','','COUR_1.php');
		$pdf->AddFont('couriernewb','B','COURBD_1.php');
		$pdf->SetFont('Times','',14);
		$pdf->Cell(190,2,'SURAT '.strtoupper($data['keterangan']),0,1,'C');
		$pdf->SetFont('Courier','',9);
		$pdf->Cell(10,3,'',0,1);
		$pdf->Cell(190,2,'Tanggal : '.tglpanjang($data['tgl_izin']),0,1,'C');
		// Kumpulan garis
		$pdf->Line(10,20,200,20);
		$pdf->Line(10,20,10,55);
		$pdf->Line(40,20,40,55);
		$pdf->Line(105,20,105,48);
		$pdf->Line(135,20,135,48);
		$pdf->Line(200,20,200,55);
		$pdf->Line(10,27,200,27);
		$pdf->Line(10,34,200,34);
		$pdf->Line(10,41,200,41);
		$pdf->Line(10,48,200,48);
		$pdf->Line(10,55,200,55);

		$pdf->Line(10,57,200,57);
		$pdf->Line(10,64,200,64);
		$pdf->Line(10,80,200,80);
		$pdf->Line(10,57,10,80);
		$pdf->Line(57,57,57,80);
		$pdf->Line(105,57,105,80);
		$pdf->Line(152,57,152,80);
		$pdf->Line(200,57,200,80);
		// end Kumpulan garis 
		$pdf->SetFont('couriernew','',10);
		$pdf->Cell(10,6,'',0,1);
		$pdf->Cell(30,2,'Nama');
		$pdf->Cell(65,2,$data['nama']);
		$pdf->Cell(30,2,'Noinduk');
		$pdf->Cell(65,2,$data['noinduk']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(30,2,'Jabatan');
		$pdf->Cell(65,2,$data['jabatan']);
		$pdf->Cell(30,2,'Bagian/Group');
		$pdf->Cell(65,2,$data['bagian']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(30,2,'Masuk Jam');
		$pdf->Cell(65,2,$data['masuk']);
		$pdf->Cell(30,2,'Pulang Jam');
		$pdf->Cell(65,2,$data['pulang']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(30,2,'Keluar Jam');
		$pdf->Cell(65,2,$data['keluar']);
		$pdf->Cell(30,2,'Kembali Jam');
		$pdf->Cell(65,2,$data['kembali']);
		$pdf->Cell(10,7,'',0,1);
		$pdf->Cell(30,2,'Alasan');
		$pdf->Cell(160,2,$data['alasan']);
		$pdf->Cell(10,9,'',0,1);
		$pdf->Cell(47,2,'yang Bersangkutan,',0,0,'C');
		$pdf->Cell(48,2,'Chief Of Leader,',0,0,'C');
		$pdf->Cell(47,2,'Supervisor,',0,0,'C');
		$pdf->Cell(48,2,'Personalia,',0,0,'C');
		$pdf->Output($file,'D');
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
		$pdf->Cell(65,2,'( '.$data['lama'].' )');
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
		$pdf->SetFont('trebuchet','',5);
		$pdf->Cell(62,2,'Dokumen ini telah ditandatangani secara digital.');
		$pdf->SetFont('trebuchet','',9);
		$pdf->Cell(3,2,'');
		$pdf->Cell(65,2,'('.trim($data['nama']).')');
		if($data['id_jabat'] <= 4){
			$pdf->Cell(10,6,'',0,1);
			$pdf->Cell(44,2,'Menyetujui',0,0,'C');
			$pdf->Cell(44,2,'Menyetujui',0,0,'C');
			$pdf->Cell(44,2,'Mengetahui,',0,0,'C');
			$pdf->Cell(10,4,'',0,1);
			$pdf->Cell(44,2,'CHIEF OF LEADER',0,0,'C');
			$pdf->Cell(44,2,'SUPERVISOR',0,0,'C');
			$pdf->Cell(44,2,'PERSONEL MANAGER',0,0,'C');
		}else if($data['id_jabat']==5){
			$pdf->Cell(10,6,'',0,1);
			$pdf->Cell(66,2,'Menyetujui',0,0,'C');
			$pdf->Cell(66,2,'Mengetahui,',0,0,'C');
			$pdf->Cell(10,4,'',0,1);
			$pdf->Cell(66,2,'MANAGER',0,0,'C');
			$pdf->Cell(66,2,'PERSONEL MANAGER',0,0,'C');
		}else if($data['id_jabat']>=6){
			$pdf->Cell(10,6,'',0,1);
			$pdf->Cell(33,2,'Menyetujui',0,0,'C');
			$pdf->Cell(33,2,'Menyetujui',0,0,'C');
			$pdf->Cell(33,2,'Menyetujui,',0,0,'C');
			$pdf->Cell(33,2,'Mengetahui,',0,0,'C');
			$pdf->Cell(10,4,'',0,1);
			$pdf->Cell(33,2,'ASS. MANAGER',0,0,'C');
			$pdf->Cell(33,2,'MANAGER',0,0,'C');
			$pdf->Cell(33,2,'DIRECTOR',0,0,'C');
			$pdf->Cell(33,2,'PERSONEL MANAGER',0,0,'C');
		}
		$pdf->Cell(10,15,'',0,1);
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
		$qr = $this->cetakqr($jenis,$id,$data['dibuat'],$data['disetujui_tgl'],$data['nama_setuju'],$data['diterima_tgl'],$data['nama_terima']);
		$pdf->Image(base_url().$qr.'.png',15,127,20);
		$pdf->Output($file,'D');
	}

	function cetakqr($jenis,$id,$dibuat,$setuju,$namasetuju,$terima,$namaterima){	
		// $tempdir = base_url()."assets/page/images/qr/";
		$tempdir = "temp/";
		$namafile = $jenis.'-'.$id;
		$enter = '\r\n';
		if (!file_exists($tempdir)) //Buat folder bername temp
		mkdir($tempdir);
		if($namasetuju!=''){
			if($namaterima!=''){
				$kata = "\r\napprove : ".date('d-m-Y H:i:s', strtotime($setuju))." oleh : ".$namasetuju."\r\nHRD : ".date('d-m-Y H:i:s', strtotime($terima))."oleh : ".$namaterima;
			}else{
				$kata = "\r\napprove : ".date('d-m-Y H:i:s', strtotime($setuju))." oleh : ".$namasetuju."\r\nHRD : ";
			}
		}else{
			$kata = "\r\napprove : \r\nHRD : ";
		}
		$codeContents = "dibuat : ".date('d-m-Y H:i:s', strtotime($dibuat)).$kata;
		QRcode::png($codeContents, $tempdir . $namafile. '.png', QR_ECLEVEL_L, 1);
		// QRcode::png($codeContents, $tempdir . '02.png', QR_ECLEVEL_L, 2);
		// QRcode::png($codeContents, $tempdir . '03.png', QR_ECLEVEL_L, 3);
		// QRcode::png($codeContents, $tempdir . '04.png', QR_ECLEVEL_L, 4);
		return $tempdir.$jenis.'-'.$id;
	}

	public function cekqr(){
		$text = " PRODUCT ID 23456";

		QRcode::png($text);
	}

	public function logout(){
		$this->session->sess_destroy();
		$url = base_url();
		redirect($url);
	}
}