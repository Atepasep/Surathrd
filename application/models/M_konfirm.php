<?php
class M_konfirm extends CI_Model{
	public function konfirmizin($jenis,$id){
		$iduser = $this->session->userdata('kritper');
		if($jenis=='IP'){
			$query = $this->db->query("update izin set ceksatpam = '".$iduser."', ceksatpam_tgl = now() where id = ".$id);
		}else{
			if($jenis=='IE'){
				$hasil = $this->db->query("select * from izin where id = ".$id)->row_array();
				if($hasil['ceksatpam']==''){
					$query =$this->db->query("update izin set ceksatpam = '".$iduser."', ceksatpam_tgl = now() where id = ".$id);
				}else{
					$hourMin = date('H:i');
					$query =$this->db->query("update izin set kembali= '".$hourMin."', ceksatpam = '".$iduser."', ceksatpam_tgl = now() where id = ".$id);
				}
			}
		}
		if($query){
			$hasil =$this->db->query("select * from izin where id = ".$id);
		}
		return $hasil;
	}
}
