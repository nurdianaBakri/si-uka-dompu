<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanTolak extends CI_Controller 
{ 
    public function __construct()
    { 
        parent::__construct();
        ob_start();
        $this->load->library('Session');
        $this->load->helper('cookie');
        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login");
        }   
    }

    public function index()
    { 
        $data['title']="List Pengajuan di Tolak";
        $data['title_box']="List Pengajuan di Tolak ";
        $data['title_header']="Silahkan masukkan NIP untuk mencari user ";

        //get data tabel pengguna
        $this->load->view('top',$data);
        $this->load->view('admin/pengajuan_ditolak/index', $data);
        $this->load->view('boton');
    }


    public function get_data()
    {
        //get data tabel pengguna
        $data['data'] = $this->M_pengajuan->getPengajuanDitolak();
        $this->load->view('admin/pengajuan_ditolak/data_pegwai',$data);
    }
 
     public function formCari()
    {
        $this->load->view('admin/pengajuan_ditolak/formcari');
    } 

    public function cari()
    {
        $data = array();  
        $keyword = $this->input->post('keyword'); 
        $data['data']= $this->M_listpegawai->cari($keyword);   
        $this->load->view('admin/pengajuan_ditolak/hasil_cari',$data);
    }

    public function detail($jenis_kp, $NIK)
    {
        $data['title']="List Pengajuan di Tolak";
        $data['title_box']="List Pengajuan di Tolak ";
        $data['title_header']="Detail Pegawai ". $NIK;
        $data['title_header2']="Detail Pegawai ". $NIK; 

        //cek session 
        $cek = $this->M_pengajuan->detail( array('NIP_BARU' => $NIK, 'jenis_kp'=> $jenis_kp));

        // cek apakah $id_peangajuan ada di DB
        if ($cek->num_rows()>0)
        {
            $where = array(
                'NIK' => $NIK, 
            );  
            $data['data'] = $this->M_kpStrukural->detail($where); 

            $where['jenis_kp'] = $jenis_kp;         
            $data['pengajuan'] = $this->M_pengajuan->detail($where)->row_array();

            $this->load->view('top',$data);
            $this->load->view('admin/pengajuan_ditolak/detail',$data);
            $this->load->view('boton'); 
        }
        else
        {
            $this->session->set_flashdata('pesan','Data pengajuan Tidak Di Temukan'); 
            
            $this->load->view('top',$data);
            $this->load->view('pengajuan/page_invalid',$data);
            $this->load->view('boton');
        }  
         
    }
 

}