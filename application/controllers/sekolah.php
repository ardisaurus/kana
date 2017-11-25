<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}
	
	public function index()
	{
        if ($this->session->userdata('namasekolah')) {            
            $this->session->unset_userdata('namasekolah');
        }

		date_default_timezone_set('Asia/Jakarta');
		$data['tanggal']=date("Y-m-d");

		$config['base_url']=base_url()."sekolah/index";
        $config['total_rows']= $this->db->query("SELECT * FROM `pendidikan` WHERE `jenis`=0;")->num_rows();
        $config['per_page']=10;
        $config['num_links']=3;
        $config['uri_segment']=3;
        $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
        $config['first_link']='< Pertama';
        $config['last_link']='Terakhir >';
        $config['next_link']='>';
        $config['prev_link']='<';
        $this->pagination->initialize($config);

        $data['provinsi']=$this->m_wilayah->get_all_provinsi();                
        $data['path'] = base_url('assets');

        $data['datapendidikan']=$this->m_jenjang->getsekolah($config);		
        $data['title']='Jenjang Pendidikan';               
        $data['page']='v_sekolah';
		$this->load->view('v_dashboard', $data);
	}

    public function cari()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['tanggal']=date("Y-m-d");

        if(isset($_POST['submit'])){       
            $this->form_validation->set_rules('nama','nama','trim|min_length[4]|max_length[50]|required');
            if ($this->form_validation->run() == FALSE)
            {   
                $this->session->set_flashdata('warning',validation_errors());
                redirect('sekolah');
            }else{                  
                $namasekolah=$this->input->post('nama');
                $this->session->set_userdata("namasekolah", $this->input->post('nama'));
            }
              
        }else{                   
            $namasekolah=$this->session->userdata('namasekolah');
        }

        $config['base_url']=base_url()."sekolah/cari/index";
        $config['total_rows']= $this->db->query("SELECT * FROM `pendidikan` WHERE `nama` LIKE '%".$namasekolah."%' OR `nama` LIKE '%".$namasekolah."%' AND `jenis`=0 ;")->num_rows();
        $config['per_page']=10;
        $config['num_links']=3;
        $config['uri_segment']=4;
        $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
        $config['first_link']='< Pertama';
        $config['last_link']='Terakhir >';
        $config['next_link']='>';
        $config['prev_link']='<';
        $this->pagination->initialize($config);

        $data['datapendidikan']=$this->m_jenjang->getcari_sekolah($namasekolah, $config);

        $data['provinsi']=$this->m_wilayah->get_all_provinsi();                
        $data['path'] = base_url('assets');

        $data['title']='Jenjang Pendidikan';
        $data['page']='v_sekolah';
        $this->load->view('v_dashboard', $data);
    }

	function add_ajax_kab($id_prov){
        $query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
        $data = "<option value=''>- Select Kabupaten -</option>";
        foreach ($query->result() as $value) {
            $data .= "<option value='".$value->id."'>".$value->nama."</option>";
        }
        echo $data;
    }

    function cek_propinsi($input){
        if($input=="0"){                
            $this->form_validation->set_message('cek_propinsi', 'Pilih propinsi asal!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

    function cek_kabupaten($input){
        if($input=="0"){                
            $this->form_validation->set_message('cek_kabupaten', 'Pilih kabupaten asal!');
            return FALSE;
        }else{            
            return TRUE;
        }
    }

	function cek_nama($input){
        $cek=$this->m_jenjang->ceknamalembaga($input);
            if($cek->num_rows()>0){                
                $this->form_validation->set_message('cek_nama', 'Nama lembaga telah digunakan, gunakan nama lain!');            
                return FALSE;
            }else{            
                return TRUE;
            }
    }

    function tambahsekolah(){        
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[50]|callback_cek_nama');     
        $this->form_validation->set_rules('alamat','alamat','required|trim');  
        $this->form_validation->set_rules('propinsi','propinsi','required|trim|callback_cek_propinsi');    
        $this->form_validation->set_rules('kota','kabupaten/kota','required|trim|callback_cek_kabupaten');
        if ($this->form_validation->run() == FALSE)
        {   
            $this->session->set_flashdata('warning',validation_errors());
        	redirect('sekolah');

        }else{                                   
            $data['nama']=$this->input->post('nama');  
            $data['jenis']=0;  
            $data['alamat']=$this->input->post('alamat');            
            $data['id_propinsi']=$this->input->post('propinsi');
            $data['id_kota']=$this->input->post('kota');
            $this->m_jenjang->tambah($data);
            $this->session->set_flashdata('message','Sekolah berhasil ditambahkan.'); 
        	redirect('sekolah'); 
        }
	}

	function hapuslembaga(){
    	$data['id_lembaga']=$this->input->post('id_lembaga');
        $this->m_jenjang->hapuslembaga($data);            
        $this->session->set_flashdata('message','Lembaga pendidikan berhasil dihapus.');
        redirect('sekolah');
    }

    function detaillembaga(){
        $id_lembaga=$this->uri->segment(3);
        $id=$id_lembaga;
        $cek=$this->m_jenjang->ceklembagajurusan($id);
        if($cek->num_rows()>0){                      	
        	$data['datalembaga']=$this->m_jenjang->getlembagabyid($id);

        	$config['base_url']=base_url()."sekolah/detail/$id/index";
	        $config['total_rows']= $this->db->query("SELECT * FROM jurusan WHERE `id_lembaga`=$id;")->num_rows();
	        $config['per_page']=10;
	        $config['num_links']=3;
	        $config['uri_segment']=5;
	        $config['next_tag_open'] = '<li>'; $config['next_tag_close'] = '</li>';
	        $config['prev_tag_open'] = '<li>'; $config['prev_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li><a class="bg-orange">'; $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li>'; $config['num_tag_close'] = '</li>';
	        $config['first_link']='< Pertama';
	        $config['last_link']='Terakhir >';
	        $config['next_link']='>';
	        $config['prev_link']='<';
	        $this->pagination->initialize($config);

	        $data['provinsi']=$this->m_wilayah->get_all_provinsi();                
	        $data['path'] = base_url('assets');

	        $data['datapendidikan']=$this->m_jenjang->getsekolah($config);	

        	$data['datajurusan']=$this->m_jenjang->getjurusan($id, $config);
            date_default_timezone_set('Asia/Jakarta');
            $data['tanggal']=date("Y-m-d");            
            $data['title']='Detail Lembaga Pendidikan';                
            $data['page']='v_detailsekolah';        
            $this->load->view('v_dashboard', $data);
        }else{
        	redirect('sekolah'); 
        }       
    }

    function ubahlembaga(){        
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');    
        $this->form_validation->set_rules('alamat','alamat','required|trim');  
        $id=$this->input->post('id_lembaga');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
        	redirect("sekolah/detaillembaga/$id");           
        }else{
            $id_lembaga=$this->input->post('id_lembaga');
            $data['alamat']=$this->input->post('alamat');         
            $data['nama']=$this->input->post('nama');
            $this->m_jenjang->ubahlembaga($id_lembaga, $data);        
            $this->session->set_flashdata('message','Detail lembaga pendidikan berhasil diubah.');
        	redirect("sekolah/detaillembaga/$id");           
        }
    }

    function ubahkota(){        
        $this->form_validation->set_rules('propinsi','propinsi','required|trim|callback_cek_propinsi');    
        $this->form_validation->set_rules('kota','kabupaten/kota','required|trim|callback_cek_kabupaten');  
        $id=$this->input->post('id_lembaga');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
        	redirect("sekolah/detaillembaga/$id");           
        }else{
            $id_lembaga=$this->input->post('id_lembaga');            
            $data['id_propinsi']=$this->input->post('propinsi');
            $data['id_kota']=$this->input->post('kota');
            $this->m_jenjang->ubahlembaga($id_lembaga, $data);        
            $this->session->set_flashdata('message','Detail lembaga pendidikan berhasil diubah.');
        	redirect("sekolah/detaillembaga/$id");           
        }
    }

    function tambahjurusan(){     
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');        
        $id=$this->input->post('id_lembaga');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('warning',validation_errors());
            redirect("sekolah/detaillembaga/$id");           
        }else{                                                        
            $data['nama']=$this->input->post('nama');                 
            $data['jenis']=$this->input->post('jenis');                                                        
            $data['id_lembaga']=$id;
            $this->m_jenjang->tambahjurusan($data);            
            $this->session->set_flashdata('message','Jurusan berhasil ditambahkan.');
            redirect("sekolah/detaillembaga/$id");           
        }
	}

	function hapusjurusan(){
    	$data['id_jurusan']=$this->input->post('id_jurusan');        
        $id=$this->input->post('id_lembaga');
        $this->m_jenjang->hapusjurusan($data);            
        $this->session->set_flashdata('message','Jurusan berhasil dihapus.');
        redirect("sekolah/detaillembaga/$id");           
    }

    function ubahjurusan(){        
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');
        $id=$this->input->post('id_lembaga');        
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("sekolah/detaillembaga/$id");           
        }else{
            $id_jurusan=$this->input->post('id_jurusan');
            $data['nama']=$this->input->post('nama');
            $this->m_jenjang->ubahjurusan($id_jurusan, $data);        
            $this->session->set_flashdata('message','Nama jurusan berhasil diubah.');
        	redirect("sekolah/detaillembaga/$id");           
        }
    }
}