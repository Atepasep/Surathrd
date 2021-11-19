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
}
