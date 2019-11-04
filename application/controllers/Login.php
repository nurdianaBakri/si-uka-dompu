<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    { 
    	parent::__construct();  
    	if($this->M_login->logged_id()!=NULL)
        {   
           	if ($this->session->userdata('level')=='Admin') {
				redirect('Listpegawai');
	        }
	        else
	        {
				redirect('Datadiri/index/'.$this->session->userdata('NIK')); 
	        } 
        } 
    }


    public function index()
    {   
		$this->load->view('login/login');
    }

    public function logine()
    { 
        //get data dari FORM
        $username = $this->input->post("u", TRUE);
        $password = $this->input->post('p', TRUE);
        //checking data via model
        $checking = $this->M_login->check_login($username, $password);
 
        //jika ditemukan, maka create session
        if ($checking != FALSE) {
            foreach ($checking as $apps) {

                $session_data = array(
                    'NIP_BARU'=> $apps->NIP_BARU,
		            'NIK'=> $apps->NIK,
		            'NAMA'=> $apps->NAMA,
		            'level'=> $apps->level,
		            'logged_in'=>TRUE,
                );
                //set session userdata
                $this->session->set_userdata($session_data);

                if ($this->session->userdata('level')=='Admin') {
					redirect('Listpegawai');
		        }
		        else
		        {
					redirect('Datadiri/index/'.$this->session->userdata('NIK')); 
		        } 
            }
        }else{ 
			$this->session->set_flashdata('pesan','username dan password tidak cocok, silahkan coba kembali'); 
            redirect('Login');
        }
    }  
	 

	public function logout()
	{ 
		$this->session->sess_destroy();
		redirect('Login');
	} 

}
