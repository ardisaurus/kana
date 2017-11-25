<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}

	public function index(){
		date_default_timezone_set('Asia/Jakarta');
		$data['tanggal']=date("Y-m-d");

		$config['base_url']=base_url()."divisi/index";
        $config['total_rows']= $this->db->query("SELECT * FROM divisi;")->num_rows();
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

        $data['datadivisi']=$this->m_divisi->getdivisi($config);
        $data['title']='Divisi';               
        $data['page']='v_divisi';
		$this->load->view('v_dashboard', $data);
	}

	function tambah(){     
        $this->form_validation->set_rules('nama','nama','required|trim|callback_cek_nama|min_length[4]|max_length[100]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('warning',validation_errors());
            redirect('divisi');
        }else{                                                        
            $data['nama']=$this->input->post('nama');
            $this->m_divisi->tambah($data);            
            $this->session->set_flashdata('message','Divisi berhasil ditambahkan.');
            redirect('divisi');           
        }
	}

	function cek_nama($input){
        $cek=$this->m_divisi->cekdivisi($input);
            if($cek->num_rows()>0){                
                $this->form_validation->set_message('cek_nama', 'Nama divisi telah digunakan, gunakan nama lain!');            
                return FALSE;
            }else{            
                return TRUE;
            }
    }

    function hapus(){
    	$data['id_divisi']=$this->input->post('id_divisi');
        $this->m_divisi->hapusdivisi($data);            
        $this->session->set_flashdata('message','Divisi berhasil dihapus.');
        redirect('divisi');
    }

    function ubah(){        
        $this->form_validation->set_rules('nama','nama','required|trim|callback_cek_nama|min_length[4]|max_length[100]');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect('divisi');
        }else{
            $id_divisi=$this->input->post('id_divisi');        
            $data['nama']=$this->input->post('nama');
            $this->m_divisi->ubahdivisi($id_divisi, $data);        
            $this->session->set_flashdata('message','Nama divisi berhasil diubah.');
            redirect('divisi/index');
        }
    }

    function pembimbing(){
        $id_divisi=$this->uri->segment(3);
        $cek=$this->m_divisi->cekdivisipembimbing($id_divisi);
        if($cek->num_rows()>0){                      	
        	$data['datanamadivisi']=$this->m_divisi->getnamadivisi($id_divisi);

        	$config['base_url']=base_url()."divisi/pembimbing/$id_divisi/index";
	        $config['total_rows']= $this->db->query("SELECT * FROM pembimbing;")->num_rows();
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

        	$data['datapembimbing']=$this->m_divisi->getpembimbing($id_divisi, $config);
            date_default_timezone_set('Asia/Jakarta');
            $data['tanggal']=date("Y-m-d");            
            $data['title']='Detail Pembimbing';                
            $data['page']='v_pembimbing';        
            $this->load->view('v_dashboard', $data);
        }else{
            redirect("divisi/index");
        }       
    }

    function tambahpembimbing(){     
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');        
        $id=$this->input->post('id_divisi');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('warning',validation_errors());
            redirect("divisi/pembimbing/$id");           
        }else{                                                        
            $data['nama']=$this->input->post('nama');                                                        
            $data['id_divisi']=$id;
            $this->m_divisi->tambahpembimbing($data);            
            $this->session->set_flashdata('message','Pembimbing berhasil ditambahkan.');
            redirect("divisi/pembimbing/$id");           
        }
	}

	function hapuspembimbing(){
    	$data['id_pembimbing']=$this->input->post('id_pembimbing');        
        $id=$this->input->post('id_divisi');
        $this->m_divisi->hapuspembimbing($data);            
        $this->session->set_flashdata('message','Pembimbing berhasil dihapus.');
        redirect("divisi/pembimbing/$id");           
    }

    function ubahpembimbing(){        
        $this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[100]');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('warning',validation_errors());
            redirect("divisi/pembimbing/$id");           
        }else{
            $id_pembimbing=$this->input->post('id_pembimbing');
            $id=$this->input->post('id_divisi');        
            $data['nama']=$this->input->post('nama');
            $this->m_divisi->ubahpembimbing($id_pembimbing, $data);        
            $this->session->set_flashdata('message','Nama pembimbing berhasil diubah.');
        	redirect("divisi/pembimbing/$id");           
        }
    }
}
?>
