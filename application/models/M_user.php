<?php
class M_user extends CI_Model {
	public function getuser(){
		$sql = "SELECT a.*,b.nama,b.jabatan,b.idkey FROM akses_departemen a
				LEFT JOIN mperson b ON a.noinduk = b.noinduk ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getdetailuser($id,$cek=0){
		// $sql = $this->db->where('idkey',$id)->get('mperson');
		$sql = $this->db->query("SELECT a.*,b.id AS id_jabat FROM mperson a 
		left join jabatan b ON a.jabatan = b.namajabatan  
		where a.idkey='".$id."' ");
		return $sql;
	}
	public function getdatauser($id,$cek=0){
		$sql = "SELECT a.*,b.nama,b.jabatan,b.idkey FROM akses_departemen a
				LEFT JOIN mperson b ON a.noinduk = b.noinduk WHERE b.idkey = '".$id."'  ";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getbagian(){
		$query = $this->db->query("select * from bagian order by id");
		return $query;
	}
	public function getgroup(){
		$query = $this->db->query("select * from grp order by id");
		return $query;
	}
	public function editakses($nik){
		$query = $this->db->query("select * from mperson where noinduk = '".$nik."' ");
		return $query;
	}
	public function editakses2($nik,$ke){
		$query = $this->db->query("select * from akses_departemen where noinduk = '".$nik."' ")->row_array();
		$hakdep = $query['hakdep'];
		$tampung = substr($hakdep,$ke-1,1)=='1' ? '0' : '1';
		$hasil = substr_replace($hakdep,$tampung,$ke-1,1);
		$queryfinal = $this->db->query("update akses_departemen set hakdep = '".$hasil."' where noinduk = '".$nik."' ");
		return $queryfinal;
	}
	public function editaksesgrp($nik,$ke){
		$query = $this->db->query("select * from akses_departemen where noinduk = '".$nik."' ")->row_array();
		$hakgrp = $query['hakgrp'];
		$tampung = substr($hakgrp,$ke-1,1)=='1' ? '0' : '1';
		$hasil = substr_replace($hakgrp,$tampung,$ke-1,1);
		$queryfinal = $this->db->query("update akses_departemen set hakgrp = '".$hasil."' where noinduk = '".$nik."' ");
		return $queryfinal;
	}
	public function updateidkey($key){
		$krit = $this->session->userdata('kritper');
		$query = $this->db->query("update mperson set idkey = '".$key."' where concat(trim(kritkar),trim(person_id)) = '".$krit."' ");
		if($query){
			$this->session->set_userdata('iduser',$key);
			$query2 = $this->db->query("select * from mperson where idkey = '".$key."' and concat(trim(kritkar),trim(person_id)) = '".$krit."' ");
		}
		return $query2;
	}
	public function cekidkey($key){
		$query2 = $this->db->query("select * from mperson where idkey = '".$key."' ");
		return $query2;
	}
	public function getdatauserkrit($kritper){
		$query2 = $this->db->query("select * from mperson where concat(kritkar,person_id) = '".$kritper."' ");
		return $query2;
	}
	public function getnamaapprover($bagian,$col){
		$query = $this->db->query("select * from bagian where bagian = '".$bagian."' ")->row_array();
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		if(!in_array($this->session->userdata('bagian'),$departemen)){
			$query2 = $this->db->query("SELECT a.*,b.nama,b.noinduk,c.namajabatan,c.id AS idjabatan,b.jenkel FROM akses_departemen a
			left join mperson b ON a.noinduk = b.noinduk
			LEFT JOIN jabatan c ON b.jabatan = c.namajabatan
			where SUBSTR(a.hakdep,".$query['id'].",1)='1' AND c.id > ".$this->session->userdata('id_jabatan')."
			ORDER BY c.id");
		}else{
			$query2 = $this->db->query("SELECT a.*,b.nama,b.noinduk,c.namajabatan,c.id AS idjabatan,b.jenkel FROM akses_departemen a
			left join mperson b ON a.noinduk = b.noinduk
			LEFT JOIN jabatan c ON b.jabatan = c.namajabatan
			where SUBSTR(a.hakdep,".$query['id'].",1)='1' AND IF(".$col." = 1,c.id > 4, b.grp = '".$this->session->userdata('grp')."' AND c.id > ".$this->session->userdata('id_jabatan').") 
			ORDER BY c.id");
		}
		return $query2;
	}
	public function simpanfotoprofile(){
		$data = $_POST;
		$temp = $this->getdatauserkrit($this->session->userdata('kritper'))->row_array();
		$fotodulu = FCPATH.'assets/page/images/user/FOTO/'.$temp['foto']; //base_url().$gambar.'.png';
		if(file_exists($fotodulu)){
			unlink($fotodulu);
		}
		$id = $this->session->userdata('kritper');
		$data['foto'] = $this->uploadLogo();
		unset($data['dokumen']);
		$query = $this->db->query("update mperson set foto = '".$data['foto']."' where concat(kritkar,person_id) = '".$id."' ");
		if($query){
			$this->session->set_userdata('foto',$data['foto']);
			$this->session->set_flashdata('simpanfoto','berhasil');
		}
		$url = base_url().'profile';
		redirect($url);
	}
	public function uploadLogo(){
		$this->load->library('upload');
		$this->uploadConfig = array(
			'upload_path' => LOK_UPLOAD_MESIN,
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
