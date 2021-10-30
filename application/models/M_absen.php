<?php
class M_absen extends CI_Model {
	public function getdata(){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("SELECT a.*,b.keterangan AS namacuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		WHERE a.noinduk = '".$noinduk."' order by a.dibuat desc ");
		return $query; //->result_array();
	}
	public function simpanabsen(){
		$data= $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dari'] = tglmysql($data['dari']);
		$data['sampai'] = tglmysql($data['sampai']);
		$data['dibuat'] = date("Y-m-d H:i:s");
		$data['dok'] = $this->uploadLogo();
		unset($data['jnizinx']);
		unset($data['dokumen']);
		$this->db->insert('ketabsen',$data);
		$url = base_url().'apps';
		redirect($url);
	}
	public function gettask(){
		// $query = $this->db->query("Select count(jncuti) AS jmlcuti,b.gr AS gr from cuti a 
		// left join jeniscuti b ON b.kode = a.jncuti  
		// WHERE a.approve IS NULL 
		// GROUP BY gr
		// ORDER BY gr");
		$bag = $this->session->userdata('bagian');
		$query = $this->db->query("Select count(jncuti) AS jmlcuti,b.gr AS gr,c.bagian,d.id as id_jabatan from cuti a 
		left join jeniscuti b ON b.kode = a.jncuti  
		LEFT JOIN mperson c ON a.noinduk = c.noinduk 
		LEFT JOIN jabatan d ON c.jabatan = d.namajabatan 
		WHERE a.approve=0 AND bagian = '".$bag."' 
		GROUP BY gr,bagian,id_jabatan
		ORDER BY gr ");
		return $query->result_array();
	}

	public function getdataabsen(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from ketabsen a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jnabsen = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat." order by a.dibuat asc");
		return $query->result_array();
	}

	public function getdatadetailabsen($id){
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima from ketabsen a 
		left join mperson b on b.noinduk = a.noinduk
		left join jeniscuti c on a.jnabsen = c.kode
		left join mperson d on d.noinduk = a.disetujui
		left join mperson e on e.noinduk = a.diterima
		where id='".$id."' ");
		return $query->row_array();
	}

	public function hapusdata($id){
		$query = $this->db->query("delete from ketabsen where id ='".$id."' ");
		return $query;
	}

	public function isiapproveabsen($id){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update ketabsen set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}
	public function tolakdataabsen($id,$alasan){
		$noinduk = $this->session->userdata('noinduk');
		$query = $this->db->query("update ketabsen set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
		return $query;
	}

	public function uploadLogo(){
		$this->load->library('upload');
		$this->uploadConfig = array(
			'upload_path' => LOK_UPLOAD_USER,
			'allowed_types' => 'gif|jpg|jpeg|png',
			'max_size' => max_upload() * 1024,
		);
		// Adakah berkas yang disertakan?
		$adaBerkas = $_FILES['dokumen']['name'];
		if (empty($adaBerkas))
		{
			return NULL;
		}
		$uploadData = NULL;
		$this->upload->initialize($this->uploadConfig);
		if ($this->upload->do_upload('dokumen'))
		{
			$uploadData = $this->upload->data();
			$namaFileUnik = $uploadData['file_name'];
			$fileRenamed = rename(
				$this->uploadConfig['upload_path'].$uploadData['file_name'],
				$this->uploadConfig['upload_path'].$namaFileUnik
			);
			$uploadData['file_name'] = $fileRenamed ? $namaFileUnik : $uploadData['file_name'];
		}
		else
		{
			$_SESSION['success'] = -1;
			$tidakupload = $this->upload->display_errors(NULL, NULL);
			$this->session->set_flashdata('msg',$tidakupload);
		}
		return (!empty($uploadData)) ? $uploadData['file_name'] : NULL;
	}
}
