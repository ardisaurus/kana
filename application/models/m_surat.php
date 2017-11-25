<?php
class M_surat extends CI_Model{

// =========================== Admin Section End ===============================

		function getsurat($config){	
			$this->db->select('*');
			$this->db->order_by('id_surat', 'DESC');
			$hasilquery=$this->db->get('surat', $config['per_page'], $this->uri->segment(3));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function hapussurat($data){
			$query = $this->db->query("SELECT * FROM surat WHERE id_surat=".$data['id_surat']);
			foreach ($query->result() as $row)
			{
			        $this->db->where('no_surat_keluar', $row->no_surat_keluar);
					$this->db->delete('suratpeserta');
			}

			$this->db->where('id_surat', $data['id_surat']);
			$this->db->delete('surat');
		}
		
		function tambah($data){
			$this->db->insert('surat', $data);
			return;
		}

		function ceknomorsuratkeluar($no_surat_keluar){
			$this->db->where('no_surat_keluar', $no_surat_keluar);
	        return $this->db->get("surat");
		}

		function ceksurat($id){
			$this->db->where('id_surat', $id);
	        return $this->db->get("surat");
		}

		function getsuratbyid($id){	
			$this->db->select('*');
			$this->db->where('id_surat', $id);		
			$hasilquery=$this->db->get('surat');
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function ubahsurat($id_surat, $data){
			$query = $this->db->query("SELECT * FROM surat WHERE id_surat=".$id_surat);
			foreach ($query->result() as $row)
			{
					$data2 = array(
		               'no_surat_keluar' => $data['no_surat_keluar']
	            	);
			        $this->db->where('no_surat_keluar', $row->no_surat_keluar);					
					$this->db->update('suratpeserta', $data2);
			}

			$this->db->where('id_surat', $id_surat);
			$this->db->update('surat', $data);
		}

		function getcari_surat($cari_no_surat_keluar, $config){ 
		$this->db->select('*');
        $this->db->from("surat");	
	    $this->db->like('no_surat_keluar', $cari_no_surat_keluar);
	    $this->db->or_like('no_surat_masuk', $cari_no_surat_keluar);	
		$hasilquery=$this->db->get("",$config['per_page'], $this->uri->segment(4));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}			
	}

// =========================== Admin Section End ===============================

		function getsuratpeserta($id){	
			$this->db->select('*');
	        $this->db->select('peserta.nama AS nama_peserta');
	        $this->db->select('peserta.waktu_mulai AS waktu_mulai');
	        $this->db->select('waktu_selesai AS waktu_selesai');
	        $this->db->select('peserta.id_divisi AS id_divisi');
	        $this->db->select('peserta.id_pembimbing AS id_pembimbing');
			$this->db->join('peserta', 'suratpeserta.id_peserta = peserta.id_peserta', 'left');
			$this->db->where('no_surat_keluar', $id);		
			$hasilquery=$this->db->get('suratpeserta');
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function getcetakpeserta($id){	
			$this->db->select('*');
	        $this->db->select('peserta.nama AS nama_peserta');
			$this->db->join('peserta', 'suratpeserta.id_peserta = peserta.id_peserta', 'left');
			$this->db->where('no_surat_keluar', $id);		
			$hasilquery=$this->db->get('suratpeserta');
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function getpeserta($config){	
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
			$this->db->order_by('id_peserta', 'DESC');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');
			$hasilquery=$this->db->get('peserta', $config['per_page'], $this->uri->segment(4));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function getpesertabylembaga($config, $id){	
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');
			$this->db->where('peserta.id_lembaga', $id);
			$this->db->order_by('id_peserta', 'DESC');
			$hasilquery=$this->db->get('peserta', $config['per_page'], $this->uri->segment(4));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}
		
		function tambahpeserta($data){
			$this->db->insert('suratpeserta', $data);
			return;
		}

		function hapuspeserta($data){
			$this->db->where('idsuratpeserta', $data['idsuratpeserta']);
			$this->db->delete('suratpeserta');
		}
}
?>