<?php
class M_absen extends CI_Model {
	public function getdata(){
		$noinduk = $this->session->userdata('noinduk');
		$krit = substr($this->session->userdata('kritper'),0,1);
		$pers = substr($this->session->userdata('kritper'),1,8);
		$query = $this->db->query("SELECT a.*,b.keterangan AS namacuti FROM cuti a
		LEFT JOIN jeniscuti b ON a.jncuti = b.kode
		WHERE  a.kritkar = ".$krit." and a.person_id = '".$pers."' order by a.dibuat desc ");
		return $query; //->result_array();
	}
	public function simpanabsen(){
		$data= $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dari'] = tglmysql($data['dari']);
		$data['sampai'] = tglmysql($data['sampai']);
		$data['dibuat'] = date("Y-m-d H:i:s");
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		// if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
		// 	$data['appcol'] = 1;
		// }
		// if($this->session->userdata('hakdep') != "'X'"){
		// 	$data['appcol'] = 1;
		// }
		if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
			if($this->session->userdata('id_jabatan') >= 5){
				$data['appcol'] = 0;
			}else{
				$data['appcol'] = 1;
			}
		}
		if($this->session->userdata('hakdep') != "'X'"){
			if($this->session->userdata('id_jabatan') >= 5){
				$data['appcol'] = 0;
			}else{
				$data['appcol'] = 1;
			}
		}
		$data['dok'] = $this->uploadLogo();
		if($data['dok']!=NULL){
			if($data['dok']=='kosong'){
				$data['dok'] = NULL;
			}
			unset($data['jnizinx']);
			unset($data['dokumen']);
			unset($data['isidokumen']);
			unset($data['idx']);
			$this->db->insert('ketabsen',$data);
			if($this->db->affected_rows() == 1){
				$this->session->set_flashdata('pesanabsen','simpanabsenberhasil');
				$url = base_url().'apps';
				redirect($url);
			}else{
				$this->session->set_flashdata('pesanabsen','simpanabsengagal');
				$url = base_url().'absen';
				redirect($url);
			}
		}else{
			$this->session->set_flashdata('ketlain','Error Upload Dok Absen '.$data['noinduk'].' ');
			$url = base_url().'absen';
			redirect($url);
		}
	}
	public function updateabsen(){
		$data= $_POST;
		$data['noinduk'] = $this->session->userdata('noinduk');
		$data['dari'] = tglmysql($data['dari']);
		$data['sampai'] = tglmysql($data['sampai']);
		$data['dibuat'] = date("Y-m-d H:i:s");
		$data['kritkar'] = substr($this->session->userdata('kritper'),0,1);
		$data['person_id'] = substr($this->session->userdata('kritper'),1,8);
		$data['dok'] = $this->uploadLogo();
		if($data['dok']=='kosong'){
			unset($data['dok']);
		}
		unset($data['jnizinx']);
		unset($data['dokumen']);
		unset($data['isidokumen']);
		$dataid = $data['idx'];
		unset($data['idx']);
		$this->db->where('id',$dataid);
		$this->db->update('ketabsen',$data);
		if($this->db->affected_rows() == 1){
			$this->session->set_flashdata('pesanabsen','simpanabsenberhasil');
			$url = base_url().'apps';
			redirect($url);
		}else{
			$this->session->set_flashdata('pesanabsen','simpanabsengagal');
			$url = base_url().'absen';
			redirect($url);
		}
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
		LEFT JOIN mperson c ON concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id)
		LEFT JOIN jabatan d ON c.jabatan = d.namajabatan 
		WHERE a.approve=0 AND bagian = '".$bag."' 
		GROUP BY gr,bagian,id_jabatan
		ORDER BY gr ");
		return $query->result_array();
	}

	public function getdataabsen(){
		$hakdep = $this->session->userdata('hakdep');
		$idjabat = $this->session->userdata('id_jabatan');
		// $grp = $this->session->userdata('grp');
		if($this->session->userdata('hakgrp') == "'X'"){
			$grp = "'".$this->session->userdata('grp')."'";
		}else{
			$grp = $this->session->userdata('hakgrp');
		}
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.id as id_jabat from ketabsen a 
		left join mperson b on concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id)
		left join jeniscuti c on a.jnabsen = c.kode
		left join jabatan d on b.jabatan = d.namajabatan
		where if(".$idjabat." > 5,if(".$idjabat." < 10,a.appcol=0 and a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat." and d.id >= 5,a.appcol=1 and a.approve=0 and b.bagian in (".$hakdep.") and d.id < ".$idjabat."),
		if(".$idjabat." <= 4 and b.bagian IN ('SPINNING','NETTING','FINISHING','RING'),a.appcol=0 and a.approve=0,a.appcol=1 and a.approve=0) and b.bagian in (".$hakdep.") and if(".$idjabat." <= 4, d.id < ".$idjabat." and b.grp IN (".$grp."),d.id < ".$idjabat.")) order by a.dibuat asc");
		return $query->result_array();
	}

	public function getdatadetailabsen($id){
		$query = $this->db->query("select a.*,b.nama,c.keterangan,d.nama AS nama_setuju,e.nama AS nama_terima,f.nama as nama_cek from ketabsen a 
		left join mperson b on concat(a.kritkar,a.person_id) = concat(b.kritkar,b.person_id)
		left join jeniscuti c on a.jnabsen = c.kode
		left join mperson d on concat(d.kritkar,d.person_id) = a.disetujui
		left join mperson e on concat(e.kritkar,e.person_id) = a.diterima
		left join mperson f on concat(f.kritkar,f.person_id) = a.cekshift
		where id='".$id."' ");
		return $query->row_array();
	}

	public function hapusdata($id){
		$getdata = $this->db->query("select * from ketabsen where id ='".$id."' ")->row_array();
		$foto_old = $getdata['dok'];
		$fotodulu = FCPATH."assets/page/images/user/".$foto_old;
		if(file_exists($fotodulu)){
			unlink($fotodulu);
		}
		$query = $this->db->query("delete from ketabsen where id ='".$id."' ");
		return $query;
	}

	public function isiapproveabsen($id){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$temp = $this->db->query("select * from ketabsen where id = '".$id."' ")->row_array();
		if($jabat >= 5){
			if($temp['appcol']==0){
				$query = $this->db->query("update ketabsen set appcol = 1,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update ketabsen set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update ketabsen set approve = 1,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update ketabsen set appcol = 1,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}
		}
		return $query;
	}
	public function tolakdataabsen($id,$alasan){
		$noinduk = $this->session->userdata('kritper');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$temp = $this->db->query("select * from ketabsen where id = '".$id."' ")->row_array();
		if($jabat >= 5){
			if($temp['appcol']==0){
				$query = $this->db->query("update ketabsen set alasan_tolak = '".$alasan."',appcol=3,cekshift='".$noinduk."',cekshift_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update ketabsen set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update ketabsen set alasan_tolak = '".$alasan."',approve=3,disetujui='".$noinduk."',disetujui_tgl = now() where id = '".$id."' ");
			}else{
				$query = $this->db->query("update ketabsen set alasan_tolak = '".$alasan."',appcol=3,cekshift='".$noinduk."',cekshift_tgl = now(),disetujui_tgl = now() where id = '".$id."' ");
			}
		}
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
			return 'kosong';
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
			$ext = pathinfo($adaBerkas, PATHINFO_EXTENSION);
			$ukuran = $_FILES['dokumen']['size']/1000000;
			$tidakupload = $this->upload->display_errors(NULL, NULL);
			$this->session->set_flashdata('msg',$tidakupload.' '.$ext.' ukuran '.round($ukuran,2).' MB');
		}
		return (!empty($uploadData)) ? $uploadData['file_name'] : NULL;
	}
	public function approvesemuadataabsen(){
		$noinduk = $this->session->userdata('kritper');
		$hakdep = $this->session->userdata('hakdep');
		$jabat = $this->session->userdata('id_jabatan');
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if($jabat >= 5){
			$query = $this->db->query("update ketabsen set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
		}else{
			if(!in_array(trim($this->session->userdata('bagian')),$departemen)){
				$query = $this->db->query("update ketabsen set approve=1,disetujui='".$noinduk."',disetujui_tgl = now() where approve = 0 and appcol = 1 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}else{
				$query = $this->db->query("update ketabsen set appcol=1,cekshift='".$noinduk."',cekshift_tgl = now() where approve = 0 and noinduk in (select noinduk from mperson where bagian in (".$hakdep."))");
			}
		}
		return $query;
	}
}
