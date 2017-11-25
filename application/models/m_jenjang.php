<?php
class M_jenjang extends CI_Model{

	function getsekolah($config){
        $this->db->select('id_lembaga');		
        $this->db->select('pendidikan.nama');	
        $this->db->select('alamat');	
        $this->db->select('id_kota');	
        $this->db->select('id_propinsi');		
        $this->db->select('wilayah_provinsi.nama AS nama_provinsi');
        $this->db->select('wilayah_kabupaten.nama AS nama_kota');	
		$this->db->join('wilayah_provinsi', 'pendidikan.id_propinsi = wilayah_provinsi.id', 'left');
		$this->db->join('wilayah_kabupaten', 'pendidikan.id_kota = wilayah_kabupaten.id', 'left');		
		$this->db->where('jenis', 0);
		$this->db->order_by('id_lembaga', 'DESC');
		$hasilquery=$this->db->get('pendidikan', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getpt($config){
        $this->db->select('id_lembaga');		
        $this->db->select('pendidikan.nama');	
        $this->db->select('alamat');	
        $this->db->select('id_kota');	
        $this->db->select('id_propinsi');		
        $this->db->select('wilayah_provinsi.nama AS nama_provinsi');
        $this->db->select('wilayah_kabupaten.nama AS nama_kota');	
		$this->db->join('wilayah_provinsi', 'pendidikan.id_propinsi = wilayah_provinsi.id', 'left');
		$this->db->join('wilayah_kabupaten', 'pendidikan.id_kota = wilayah_kabupaten.id', 'left');		
		$this->db->where('jenis', 1);
		$this->db->order_by('id_lembaga', 'DESC');
		$hasilquery=$this->db->get('pendidikan', $config['per_page'], $this->uri->segment(3));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getlembagabyid($id){
        $this->db->select('id_lembaga');		
        $this->db->select('pendidikan.nama');	
        $this->db->select('alamat');	
        $this->db->select('id_kota');	
        $this->db->select('id_propinsi');		
        $this->db->select('wilayah_provinsi.nama AS nama_provinsi');
        $this->db->select('wilayah_kabupaten.nama AS nama_kota');	
		$this->db->join('wilayah_provinsi', 'pendidikan.id_propinsi = wilayah_provinsi.id', 'left');
		$this->db->join('wilayah_kabupaten', 'pendidikan.id_kota = wilayah_kabupaten.id', 'left');		
		$this->db->where('id_lembaga', $id);		
		$hasilquery=$this->db->get('pendidikan');
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getpropinsi($id){
        $this->db->select('*');
        $this->db->from("wilayah_provinsi");
        $this->db->where('id', $id);		
		$hasilquery=$this->db->get();
		if ($hasilquery->num_rows > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function getkota($id){
        $this->db->select('*');
        $this->db->from("wilayah_kabupaten");
        $this->db->where('id', $id);		
		$hasilquery=$this->db->get();
		if ($hasilquery->num_rows > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function tambah($data){
		$this->db->insert('pendidikan', $data);
		return;
	}

	function hapuslembaga($data){
		$query = $this->db->query("SELECT * FROM peserta WHERE id_lembaga=".$data['id_lembaga']);
		foreach ($query->result() as $row)
		{
		        $this->db->where('id_peserta', $row->id_peserta);
				$this->db->delete('suratpeserta');
		}

		$this->db->where('id_lembaga', $data['id_lembaga']);
		$this->db->delete('peserta');

		$this->db->where('id_lembaga', $data['id_lembaga']);
		$this->db->delete('jurusan');

		$this->db->where('id_lembaga', $data['id_lembaga']);
		$this->db->delete('pendidikan');
	}

	function ceknamalembaga($nama){
		$this->db->where('nama', $nama);
        return $this->db->get("pendidikan");
	}

	function getjurusan($id_lembaga, $config){
        $this->db->select('id_jurusan');		
        $this->db->select('nama');	
        $this->db->select('id_lembaga');
        $this->db->select('jenis');
		$this->db->where('id_lembaga', $id_lembaga);
		$this->db->order_by('id_jurusan', 'DESC');		
		$hasilquery=$this->db->get('jurusan', $config['per_page'], $this->uri->segment(5));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}		
	}

	function ceklembagajurusan($id_lembaga){        
		$this->db->where('id_lembaga', $id_lembaga);
        return $this->db->get("pendidikan");		
	}

	function ubahlembaga($id_lembaga, $data){
		$this->db->where('id_lembaga', $id_lembaga);
		$this->db->update('pendidikan', $data);
	}

	function tambahjurusan($data){
		$this->db->insert('jurusan', $data);
		return;
	}

	function hapusjurusan($data){
		$query = $this->db->query("SELECT * FROM peserta WHERE id_jurusan=".$data['id_jurusan']);
		foreach ($query->result() as $row)
		{
		        $this->db->where('id_peserta', $row->id_peserta);
				$this->db->delete('suratpeserta');
		}

		$this->db->where('id_jurusan', $data['id_jurusan']);
		$this->db->delete('peserta');

		$this->db->where('id_jurusan', $data['id_jurusan']);
		$this->db->delete('jurusan');
	}

	function ubahjurusan($id_jurusan, $data){
		$this->db->where('id_jurusan', $id_jurusan);
		$this->db->update('jurusan', $data);
	}

	function getcari_pt($namapt, $config){        
        $this->db->select('id_lembaga');		
        $this->db->select('pendidikan.nama');	
        $this->db->select('alamat');	
        $this->db->select('id_kota');	
        $this->db->select('id_propinsi');		
        $this->db->select('wilayah_provinsi.nama AS nama_provinsi');
        $this->db->select('wilayah_kabupaten.nama AS nama_kota');	
		$this->db->join('wilayah_provinsi', 'pendidikan.id_propinsi = wilayah_provinsi.id', 'left');
		$this->db->join('wilayah_kabupaten', 'pendidikan.id_kota = wilayah_kabupaten.id', 'left');
        $this->db->from("pendidikan");	
		$this->db->where('jenis', 1);
	    $this->db->like('pendidikan.nama', $namapt);
	    $this->db->or_like('pendidikan.nama', $namapt);	
		$hasilquery=$this->db->get("",$config['per_page'], $this->uri->segment(4));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}			
	}

	function getcari_sekolah($namasekolah, $config){        
        $this->db->select('id_lembaga');		
        $this->db->select('pendidikan.nama');	
        $this->db->select('alamat');	
        $this->db->select('id_kota');	
        $this->db->select('id_propinsi');		
        $this->db->select('wilayah_provinsi.nama AS nama_provinsi');
        $this->db->select('wilayah_kabupaten.nama AS nama_kota');	
		$this->db->join('wilayah_provinsi', 'pendidikan.id_propinsi = wilayah_provinsi.id', 'left');
		$this->db->join('wilayah_kabupaten', 'pendidikan.id_kota = wilayah_kabupaten.id', 'left');
        $this->db->from("pendidikan");	
		$this->db->where('jenis', 0);
	    $this->db->like('pendidikan.nama', $namasekolah);
	    $this->db->or_like('pendidikan.nama', $namasekolah);	
		$hasilquery=$this->db->get("",$config['per_page'], $this->uri->segment(4));
		if ($hasilquery->num_rows() > 0) {
			foreach ($hasilquery->result() as $value) {
				$data[]=$value;
			}
			return $data;
		}			
	}
}
?>