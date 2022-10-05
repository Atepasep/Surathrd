<?php
class M_login extends CI_Model
{
	public function cek_login($u)
	{
		$user = encrypto($u);
		// $pass = encrypto($p);
		$query = 'SELECT a.*,b.id AS id_jabatan,c.hakdep,c.hakgrp,d.kritkar AS krit1,d.person_id AS per1,e.kritkar AS krit2,e.person_id AS per2 FROM mperson a
		LEFT JOIN jabatan b ON a.jabatan = b.namajabatan 
		left join akses_departemen c on a.noinduk = c.noinduk 
		LEFT JOIN validator d ON d.id = a.valid 
		LEFT JOIN validator e ON e.id = a.rilis
		WHERE a.idkey ="' . $u . '" ';
		$sql = $this->db->query($query);
		return $sql;
	}
	public function inputlogin($id)
	{
		$query = "update mperson set lastlogin=now() where idkey = '" . $id . "' ";
		$sql = $this->db->query($query);
		if ($sql) {
			//echo "1";
		}
	}
	public function getnamadep($id)
	{
		$sql = $this->db->query("select * from bagian where id = '" . $id . "' ");
		return $sql->row_array();
	}
	public function getnamagrp($id)
	{
		$sql = $this->db->query("select * from grp where id = '" . $id . "' ");
		return $sql->row_array();
	}
	public function adavalidator($id)
	{
		$sql = $this->db->query("select * from validator where concat(kritkar,person_id) = '" . $id . "' ");
		if ($sql->num_rows() > 0) {
			$data = $sql->row_array();
			return $data['id'];
		} else {
			return 0;
		}
	}
}
