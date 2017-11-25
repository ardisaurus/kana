<?php
class M_divisi extends CI_Model{

// =========================== Admin Section End ===============================

	function getdivisi($config){
        $this->db->select('id_divisi');		
        $this->db->select('nama');
		$this->db->order_by('id_divisi', 'DESC');		
		$hasilquery=$this->db->get('divisi', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambah($data){
		$this->db->insert('divisi', $data);
		return;
	}

	function cekdivisi($nama){
		$this->db->where('nama', $nama);
        return $this->db->get("divisi");
	}

	function hapusdivisi($data){
		$query = $this->db->query("SELECT * FROM peserta WHERE id_divisi=".$data['id_divisi']);
		foreach ($query->result() as $row)
		{
		        $this->db->where('id_peserta', $row->id_peserta);
				$this->db->delete('suratpeserta');
		}

		$this->db->where('id_divisi', $data['id_divisi']);
		$this->db->delete('peserta');
		
		$this->db->where('id_divisi', $data['id_divisi']);		
		$this->db->delete('pembimbing');

		$this->db->where('id_divisi', $data['id_divisi']);
		$this->db->delete('divisi');
	}

	function ubahdivisi($id_divisi, $data){
		$this->db->where('id_divisi', $id_divisi);
		$this->db->update('divisi', $data);
	}

	function getpembimbing($id_divisi, $config){
        $this->db->select('id_pembimbing');		
        $this->db->select('nama');	
        $this->db->select('id_divisi');
		$this->db->where('id_divisi', $id_divisi);	
		$this->db->order_by('id_pembimbing', 'DESC');	
		$hasilquery=$this->db->get('pembimbing', $config['per_page'], $this->uri->segment(5));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function cekdivisipembimbing($id_divisi){        
		$this->db->where('id_divisi', $id_divisi);
        return $this->db->get("divisi");		
	}

	function getnamadivisi($id_divisi){
        $this->db->select('id_divisi');		
        $this->db->select('nama');   
		$this->db->where('id_divisi', $id_divisi);		
		$hasilquery=$this->db->get('divisi');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambahpembimbing($data){
		$this->db->insert('pembimbing', $data);
		return;
	}

	function hapuspembimbing($data){
		$query = $this->db->query("SELECT * FROM peserta WHERE id_pembimbing=".$data['id_pembimbing']);
		foreach ($query->result() as $row)
		{
		        $this->db->where('id_peserta', $row->id_peserta);
				$this->db->delete('suratpeserta');
		}

		$this->db->where('id_pembimbing', $data['id_pembimbing']);
		$this->db->delete('peserta');
		
		$this->db->where('id_pembimbing', $data['id_pembimbing']);
		$this->db->delete('pembimbing');
	}

	function ubahpembimbing($id_pembimbing, $data){
		$this->db->where('id_pembimbing', $id_pembimbing);
		$this->db->update('pembimbing', $data);
	}

// =========================== Admin Section End ===============================
}
?>