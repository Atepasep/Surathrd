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

	public function getdatakonfirm(){
		$date = tglmysql($this->session->flashdata('tglizin'));
		$query = $this->db->query("select a.*,b.nama as nama_satpam,c.nama as nama_karyawan,d.keterangan,c.bagian as xbagian from izin a 
		left join mperson b on a.ceksatpam = concat(b.kritkar,b.person_id) 
		left join mperson c on concat(a.kritkar,a.person_id) = concat(c.kritkar,c.person_id) 
		left join jeniscuti d on a.jnizin = d.kode
		where a.ceksatpam_tgl like '".$date."%' order by c.bagian ");
		return $query;
	}
}
