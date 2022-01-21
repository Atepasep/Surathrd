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
	public function getpendidikan(){
		$query = $this->db->query("select * from tb_pendidikan order by id");
		return $query;
	}
	public function getstatusnikah(){
		$query = $this->db->query("select * from tb_statusnikah order by id");
		return $query;
	}
	public function gethubkeluarga(){
		$query = $this->db->query("select * from tb_hubkeluarga order by id");
		return $query;
	}
	public function editakses($nik){
		$query = $this->db->query("select * from mperson where noinduk = '".$nik."' ");
		return $query;
	}
	public function getdatakeluarga(){
		$person = $this->session->userdata('kritper');
		$periode = $this->session->flashdata('periodekk');
		$hasil = $this->db->query("select a.*,b.pendidikan,c.status,d.hubungan from keluarga a 
		left join tb_pendidikan b on b.id = a.id_pendidikan
		left join tb_statusnikah c on c.id = a.id_statuskawin
		left join tb_hubkeluarga d on d.id = a.id_hubkeluarga
		where a.id_mperson = '".$person."' and a.periode = '".$periode."' ");
		return $hasil;
	}
	public function getkkkeluarga(){
		$person = $this->session->userdata('kritper');
		$periode = $this->session->flashdata('periodekk');
		$hasil= $this->db->query("select nokk from keluarga where id_mperson = '".$person."' and periode = '".$periode."'");
		return $hasil;
	}
	public function getdatakeluarga_detail($id){
		$hasil = $this->db->query("select * from keluarga where id= ".$id);
		return $hasil;
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
	public function getnamaapprover($bagian,$col,$jn){
		$query = $this->db->query("select * from bagian where bagian = '".$bagian."' ")->row_array();
		$departemen = array("SPINNING","NETTING","FINISHING","RING");
		$jnsurat = array("cuti","abse");
		if($this->session->userdata('id_jabatan') >= 5 && in_array($jn,$jnsurat)){
			$query2 = $this->db->query("SELECT a.*,b.nama,b.noinduk,c.namajabatan,c.id AS idjabatan,b.jenkel FROM akses_departemen a
			left join mperson b ON a.noinduk = b.noinduk
			LEFT JOIN jabatan c ON b.jabatan = c.namajabatan
			where SUBSTR(a.hakdep,".$query['id'].",1)='1' AND IF(".$col." = 0,c.id > ".$this->session->userdata('id_jabatan').",c.id = 10)
			ORDER BY c.id");
		}else{
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
				where SUBSTR(a.hakdep,".$query['id'].",1)='1' AND IF(".$col." = 1,c.id > ".$this->session->userdata('id_jabatan').", b.grp = '".$this->session->userdata('grp')."' AND c.id > ".$this->session->userdata('id_jabatan').") 
				ORDER BY c.id");
			}
		}
		return $query2;
	}
	public function simpanfotoprofile(){
		$data = $_POST;
		$temp = $this->getdatauserkrit($this->session->userdata('kritper'))->row_array();
		$fotodulu = FCPATH.'assets/page/images/user/FOTO/'.$temp['foto']; //base_url().$gambar.'.png';
		$id = $this->session->userdata('kritper');
		$data['foto'] = $this->uploadLogo();
		if($data['foto']!=NULL){
			if($data['foto']=='kosong'){
				$data['foto'] = NULL;
			}
			if(file_exists($fotodulu)){
				unlink($fotodulu);
			}
			unset($data['dokumen']);
			$query = $this->db->query("update mperson set foto = '".$data['foto']."' where concat(kritkar,person_id) = '".$id."' ");
			if($query){
				$this->session->set_userdata('foto',$data['foto']);
				$this->session->set_flashdata('simpanfoto','berhasil');
			}
		}else{
			$this->session->set_flashdata('ketlain','Error Upload Foto Profile '.$temp['noinduk'].' ');
		}
		$url = base_url().'profile';
		redirect($url);
	}
	public function simpankeluarga(){
		$data = $_POST;
		$data['id_mperson'] = $this->session->userdata('kritper');
		$data['tgllahir'] = tglmysql($data['tglahir']);
		$data['tmplahir'] = ucwords($data['tmplahir']);
		$data['nama'] = ucwords($data['nama']);
		$data['pekerjaan'] = ucwords($data['pekerjaan']);
		$data['noinduk'] = strtoupper($data['noinduk']);
		unset($data['tglahir']);
		unset($data['id']);
		$data['periode'] = $this->session->flashdata('periodekk');
		$this->db->insert('keluarga',$data);
		$this->session->set_flashdata('periodekk',$this->session->flashdata('periodekk'));
		// $url = base_url().'profile/keluarga';
		// redirect($url);
	}
	public function updatekeluarga(){
		$data = $_POST;
		$data['id_mperson'] = $this->session->userdata('kritper');
		$data['tgllahir'] = tglmysql($data['tglahir']);
		$data['tmplahir'] = ucwords($data['tmplahir']);
		$data['nama'] = ucwords($data['nama']);
		$data['pekerjaan'] = ucwords($data['pekerjaan']);
		$data['noinduk'] = strtoupper($data['noinduk']);
		unset($data['tglahir']);
		$data['periode'] = $this->session->flashdata('periodekk');
		$this->db->where('id',$data['id']);
		$this->db->update('keluarga',$data);
		$this->session->set_flashdata('periodekk',$this->session->flashdata('periodekk'));
		// $url = base_url().'profile/keluarga';
		// redirect($url);
	}
	public function hapuskeluarga($id){
		$query = $this->db->query("delete from keluarga where id =".$id);
		return $query;
	}
	public function validasikeluarga(){
		$periode = $this->session->flashdata('periodekk');
		$person = $this->session->userdata('kritper');
		$query = $this->db->query("update keluarga set valid = 1 where id_mperson = '".$person."' and periode = ".$periode);
		return $query;
	}
	public function updatekk($kk){
		$periode = $this->session->flashdata('periodekk');
		$person = $this->session->userdata('kritper');
		$query = $this->db->query("update keluarga set nokk = '".$kk."' where id_mperson = '".$person."' and periode = ".$periode);
		return $query;
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

	function isilogerror($apl,$ket){
		$query = $this->db->query("insert into logerror(aplikasi,keterangan,tgl) values ('".$apl."','".$ket."',now()) ");
		return $query;
	}
}
