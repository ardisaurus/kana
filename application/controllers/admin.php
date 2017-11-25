<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('email')){
            redirect('login');
        }
	}

	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$data['tanggal']=date("Y-m-d");

		$config['base_url']=base_url()."admin/index";
        $config['total_rows']= $this->db->query("SELECT * FROM user;")->num_rows();
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

        $data['datapengurus']=$this->m_user->getpengurus($config);
        $data['title']='Admin';               
        $data['page']='v_admin';
		$this->load->view('v_dashboard', $data);
	}

	function tambah(){
		$this->form_validation->set_rules('nama','nama','required|trim|min_length[4]|max_length[50]');                             
        $this->form_validation->set_rules('passwordbaru','password','required|trim|min_length[6]|max_length[12]');        
        $this->form_validation->set_rules('passwordbaru2','password konfirmasi','required|trim|matches[passwordbaru]');       
        $this->form_validation->set_rules('email','email','required|trim|valid_email|callback_cek_email');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('warning',validation_errors());
            redirect('divisi');
        }else{                                    
            $data['nama']=$this->input->post('nama');                    
            $data['password']=md5($this->input->post('passwordbaru'));      
            $data['email']=$this->input->post('email');
            $this->m_user->tambah($data);            
            $this->session->set_flashdata('message','Admin berhasil ditambahkan.');
            redirect('admin');           
        }
	}

	function cek_email($input){
        $cek=$this->m_user->cekemail($input);
            if($cek->num_rows()>0){                
                $this->form_validation->set_message('cek_email', 'Email telah digunakan oleh pengguna lain!');            
                return FALSE;
            }else{            
                return TRUE;
            }
    }
}