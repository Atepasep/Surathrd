<?php
class M_user extends CI_Model {
	public function getuser(){
		$sql = "SELECT a.*,b.nama,b.jabatan,b.idkey FROM akses_departemen a
				LEFT JOIN mperson b ON a.noinduk = b.noinduk ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getdetailuser($id,$cek){
		
		// $sql = $this->db->where('idkey',$id)->get('mperson');
		$sql = $this->db->query("SELECT a.*,b.id AS id_jabat FROM mperson a 
		left join jabatan b ON a.jabatan = b.namajabatan  
		where a.idkey='".$id."' ");
		if(isset($cek)){
			return $sql;
		}else{
			return $sql->row_array();
		}
	}
	public function getdatauser($id,$cek){
		$sql = "SELECT a.*,b.nama,b.jabatan,b.idkey FROM akses_departemen a
				LEFT JOIN mperson b ON a.noinduk = b.noinduk WHERE b.idkey = '".$id."'  ";
		$query = $this->db->query($sql);
		if(isset($cek)){
			return $query;
		}else{
			return $query->result_array();
		}
	}
	public function getbagian(){
		$query = $this->db->query("select * from bagian order by id");
		return $query;
	}
	public function editakses($nik){
		$query = $this->db->query("select * from mperson where noinduk = '".$nik."' ");
		return $query;
	}
}
