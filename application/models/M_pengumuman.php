<?php
class M_Pengumuman extends CI_Model{
	public function getdata(){
		$th = $this->session->flashdata('tahsurat');
		$query = $this->db->query("Select * from pengumuman where year(tgl) = ".$th." and id_revisi = 0 order by tgl asc");
		return $query;		
	}
	public function getnodok($id,$oke){
		$query = $this->db->query("Select * from pengumuman where id =".$id);
		if($query && $oke=='aktiv'){
			$kritper = $this->session->userdata('kritper');
			$this->db->query("update read_pengumuman set nodok = concat(trim(nodok),'t','".$id."',',') where kritper ='".$kritper."' ");
		}
		return $query;
	}
	public function getjmldok($th){
		$jml = 0;
		$query = $this->db->query("select * from pengumuman where year(tgl) = ".$th);
		foreach($query->result_array() as $hasil){
			if(sudahbacapengumuman($hasil['id'])=='aktiv'){
				$jml++;
			}
		}
		return $jml;
	}
	public function getnamadok($id){
		$th = $this->session->flashdata('tahsurat')==null ? date('Y') : $this->session->flashdata('tahsurat');
		$kritper = $this->session->userdata('kritper');
		$query = $this->db->query("select * from read_pengumuman where tahun = ".$th." and  kritper = '".$kritper."' and nodok like '%t".$id.",%' ");
		return $query;
	}
	public function getdokrevisi($id){
		$th = $this->session->flashdata('tahsurat');
		$query = $this->db->query("select * from pengumuman where year(tgl) = ".$th." and id_revisi = ".$id);
		return $query;
	}
	public function cektahun($th){
		$kritper = $this->session->userdata('kritper');
		$query = $this->db->query("select * from read_pengumuman where tahun = ".$th." and kritper = '".$kritper."' ");
		if($query->num_rows() <= 0){
			$this->db->query("insert into read_pengumuman(tahun,kritper)values(".$th." ,'".$kritper."') ");
		}
	}
}
