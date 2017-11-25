<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
	function __construct(){
		parent::__construct();
        if($this->session->userdata('email')){
            $this->m_user->goPageUser();
        }
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	function proses(){
        $this->form_validation->set_rules('email','email','required|trim');
        $this->form_validation->set_rules('password','password','required|trim');
        
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Email dan password harus diisi.');
            redirect('login/index');
        }else{
            $email=$this->input->post('email');
            // cek email sudah terdaftar?
            $cek_email=$this->m_user->cekemail($email);
            if($cek_email->num_rows()>0){
                $password=$this->input->post('password');
                // cek kecocokan email dan password
                $cek=$this->m_user->cek($email, md5($password));
                if($cek->num_rows()>0){
                	//login berhasil, buat session
                    $this->session->set_userdata('email',$email);
                    $this->m_user->goPageUser();
                }else{
                	//login gagal
                    $this->session->set_flashdata('message',"Kombinasi Email dan Anda Password Salah. <a href='".site_url('login/lupa_password')."'>Klik disini jika lupa password!</a>");
                    redirect('login/index');
                }
            }else{
                //login gagal
                $this->session->set_flashdata('message','Email tidak terdaftar.');
                redirect('login/index');
            }            
        }
    }

    function lupa_password(){
        $vals = array(
        'img_path' => './assets/captcha/',
            'img_url' => base_url().'assets/captcha/',
            'img_width' => 160,
            'img_height' => 50,
            'expiration' => 600
        );
        $cap = create_captcha($vals);
        $this->session->set_userdata('keycode',$cap['word']);
        $data['captcha_img'] = $cap['image'];
        $this->load->view('v_reset', $data);
    }


    function generate_random_string() {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($alpha_numeric), 0, 8);
    }

    function reset_proses(){
        $this->form_validation->set_rules('email','Email','required|trim');
        
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Email harus diisi.');
            redirect('login/lupa_password');
        }else{
            $email=$this->input->post('email');

            // cek email sudah terdaftar?
            $cek_email=$this->m_user->cekemail($email);
            $input=$this->input->post('captcha');
            if($input==$this->session->userdata('keycode')){
               if($cek_email->num_rows()>0){
                    $email=$this->m_user->getemail($email);
                    $password=$this->generate_random_string();
                    $config = array();
                    $config['charset'] = 'utf-8';
                    $config['useragent'] = 'Codeigniter';
                    $config['protocol']= "smtp";
                    $config['mailtype']= "html";
                    $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
                    $config['smtp_port']= "465";
                    $config['smtp_timeout']= "400";
                    $config['smtp_user']= "simapel.telkom@gmail.com"; // isi dengan email kamu
                    $config['smtp_pass']= "simapel77"; // isi dengan password kamu
                    $config['crlf']="\r\n"; 
                    $config['newline']="\r\n"; 
                    $config['wordwrap'] = TRUE;
                    //memanggil library email dan set konfigurasi untuk pengiriman email
                    $this->email->initialize($config);
                    //konfigurasi pengiriman
                    $this->email->from($config['smtp_user']);
                    $this->email->to($email);
                    $this->email->subject("Reset Pasword SIMAPEL");
                    $this->email->message("Halo, kami dari Sistem Manajemen Peserta PKL menginformasikan bahwa Password berhasil direset, harap segera rubah password dari pengaturan akun setelah berhasil masuk degan password dibawah ini. Silahkan Login dengan Password : ".$password);              
                    if($this->email->send())
                    {
                        $data['password']=md5($password);
                        $this->m_user->ubahAkun($email, $data);
                        $this->session->set_flashdata('notif','Berhasil melakukan reset password, silahkan cek email '.$email.'.');
                        redirect('login');
                    }else
                    {
                       $this->session->set_flashdata('message','Email gagal dikirim.');
                       redirect('login/lupa_password');
                    }
                }else{
                    //login gagal
                    $this->session->set_flashdata('message','email tidak terdaftar.');
                    redirect('login/lupa_password');
                }
            }else{
                //login gagal
                $this->session->set_flashdata('message','Kata yang anda masukan tidak sesuai dengan gambar.');
                redirect('login/lupa_password');
            }            
        }
    }    

}