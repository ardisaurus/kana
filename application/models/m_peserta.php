<?php 
	if (!defined('BASEPATH'))exit('No direct script access allowed');

	class M_peserta extends CI_Model {
		
		function __construct() {
			parent::__construct();
		}
		
		function tambah($data){
			$this->db->insert('peserta', $data);
			return;
		}
		
		function getpesertapt($config){	
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
			$this->db->select('peserta.id_divisi');	
	        $this->db->select('divisi.nama AS nama_divisi');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
			$this->db->join('divisi', 'peserta.id_divisi = divisi.id_divisi', 'left');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');	
			$this->db->where('jenis', 1);
			$this->db->order_by('id_peserta', 'DESC');
			$hasilquery=$this->db->get('peserta', $config['per_page'], $this->uri->segment(3));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function getpesertasekolah($config){	
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
			$this->db->select('peserta.id_divisi');	
	        $this->db->select('divisi.nama AS nama_divisi');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
			$this->db->join('divisi', 'peserta.id_divisi = divisi.id_divisi', 'left');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');	
			$this->db->where('jenis', 0);
			$this->db->order_by('id_peserta', 'DESC');
			$hasilquery=$this->db->get('peserta', $config['per_page'], $this->uri->segment(3));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function hapuspeserta($data){
			$query = $this->db->query("SELECT * FROM peserta WHERE id_peserta=".$data['id_peserta']);
			foreach ($query->result() as $row)
			{
			        $this->db->where('id_peserta', $row->id_peserta);
					$this->db->delete('suratpeserta');
			}
			
			$this->db->where('id_peserta', $data['id_peserta']);
			$this->db->delete('peserta');
		}

		function cekpeserta($id_peserta){        
			$this->db->where('id_peserta', $id_peserta);
	        return $this->db->get("peserta");		
		}

		function getpesertabyid($id){	
			$this->db->select('id_peserta');
			$this->db->select('ni');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
			$this->db->select('peserta.id_divisi');		
			$this->db->select('peserta.id_jurusan');
			$this->db->select('peserta.id_lembaga');
			$this->db->select('waktu_mulai');
			$this->db->select('waktu_selesai');
	        $this->db->select('jurusan.jenis AS jenis_jurusan');	
	        $this->db->select('divisi.nama AS nama_divisi');
	        $this->db->select('jurusan.nama AS nama_jurusan');
	        $this->db->select('pendidikan.nama AS nama_lembaga');
	        $this->db->select('pembimbing.nama AS nama_pembimbing');
			$this->db->join('divisi', 'peserta.id_divisi = divisi.id_divisi', 'left');
			$this->db->join('pembimbing', 'peserta.id_pembimbing = pembimbing.id_pembimbing', 'left');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');
			$this->db->join('jurusan', 'peserta.id_jurusan = jurusan.id_jurusan', 'left');	
			$this->db->where('id_peserta', $id);		
			$hasilquery=$this->db->get('peserta');
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}
		}

		function getcari_pesertapt($namapt, $config){
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
			$this->db->select('peserta.id_divisi');	
	        $this->db->select('divisi.nama AS nama_divisi');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
			$this->db->join('divisi', 'peserta.id_divisi = divisi.id_divisi', 'left');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');
	        $this->db->select('pendidikan.jenis AS jenis');
        	$this->db->from("peserta");		
			$this->db->where('jenis', 1);
		    $this->db->like('peserta.nama', $namapt);
			$hasilquery=$this->db->get("",$config['per_page'], $this->uri->segment(4));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}			
		}

		function getcari_pesertasekolah($namapt, $config){
			$this->db->select('id_peserta');	
	        $this->db->select('peserta.nama AS nama_peserta');	
			$this->db->select('peserta.id_lembaga');
			$this->db->select('peserta.id_divisi');	
	        $this->db->select('divisi.nama AS nama_divisi');
	        $this->db->select('pendidikan.nama AS nama_pendidikan');
	        $this->db->select('pendidikan.jenis AS jenis');
			$this->db->join('divisi', 'peserta.id_divisi = divisi.id_divisi', 'left');
			$this->db->join('pendidikan', 'peserta.id_lembaga = pendidikan.id_lembaga', 'left');
        	$this->db->from("peserta");		
			$this->db->where('jenis', 0);
		    $this->db->like('peserta.nama', $namapt);
			$hasilquery=$this->db->get("",$config['per_page'], $this->uri->segment(4));
			if ($hasilquery->num_rows() > 0) {
				foreach ($hasilquery->result() as $value) {
					$data[]=$value;
				}
				return $data;
			}			
		}

		function ubahpeserta($id_peserta, $data){
			$this->db->where('id_peserta', $id_peserta);
			$this->db->update('peserta', $data);
		}
	}
?>
