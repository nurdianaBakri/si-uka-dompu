<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataUser extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
	 	if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

	public function profile($NIK)
    {
        $where = array(
            'NIK=' => $NIK,
        );

        $data['title']="Profile";
        $data['title_box']="Profile Pegawai ";
        $data['title_header']="Berikut adalah data profile Anda ";        
        $data['data'] = $this->M_user->getById("pengguna",$where)->row_array();
        
        $this->load->view("top" ,$data);
        $this->load->view("user/profile" ,$data);
        $this->load->view("boton");
    }
}
