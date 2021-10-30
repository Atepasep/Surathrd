<?php
class M_login extends CI_Model{
	public function cek_login($u){
		$user = encrypto($u);
		// $pass = encrypto($p);
		$query = 'SELECT a.*,b.id AS id_jabatan,c.hakdep FROM mperson a
		LEFT JOIN jabatan b ON a.jabatan = b.namajabatan 
		left join akses_departemen c on a.noinduk = c.noinduk 
		WHERE a.idkey ="'.$u.'" ';
		$sql = $this->db->query($query);
		return $sql;
	}
	public function inputlogin($id){
		$query = "update mperson set lastlogin=now() where idkey = '".$id."' ";
		$sql = $this->db->query($query);
		if($sql){
			//echo "1";
		}
	}
	public function getnamadep($id){
		$sql = $this->db->query("select * from bagian where id = '".$id."' ");
		return $sql->row_array();
	}
}
