<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datadiri extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
	 	if($this->session->userdata('logged_in') != TRUE){
             $this->session->set_flashdata('pesan',"Silahkan login");
            redirect("Login");
        } 
        else
        {
            if ($this->session->userdata('level') == "Admin") {
                $this->session->set_flashdata('pesan',"Anda tidak dapat mengakses halaman ini, karena anda bukan User");
                redirect("Login");
            }
            else{
               
            }
        }  
    }

	public function index($NIK)
    {

        $data['title']="Data diri";
        $data['title_box']="Data diri Pegawai ";
        $data['title_header']="Data diri Pegawai ".$NIK;
        $data['title_header2']="Data diri Pegawai ".$NIK;

        if ($this->session->userdata('level')=='User' || $this->session->userdata('NIK')==$NIK)
        {
            $where = array('NIK' => $NIK );  
            $data['data'] = $this->M_kpreguler->detail($where); 
            $data['gol_ru'] = $this->db->get('tb_golru')->result_array(); 

            if ($data['data']['data_tidak_ditemukan']==TRUE)
            {
                $this->session->set_flashdata('pesan','Data Pegawai Tidak Di Temukan'); 

                $this->load->view('top',$data);
                $this->load->view('datadiri/detail_data_tidak_ditemukan',$data);
                $this->load->view('boton'); 
            }else{
                $this->load->view('top',$data);
                $this->load->view('datadiri/detail',$data);
                $this->load->view('boton'); 
            } 
        }  
    }

    public function updatePns()
    { 
        $NIK = $this->input->post('NIK');
        $NIP = $this->input->post('NIP');
        $GLRDPN = $this->input->post('GLRDPN');
        $NAMA = $this->input->post('NAMA');
        $GLRBLKG = $this->input->post('GLRBLKG');
        $KD_GOLRU = $this->input->post('KD_GOLRU');
        $JABATAN = $this->input->post('JABATAN');
        // $KD_JABATAN = $this->input->post('KD_JABATAN');
        // $KD_UNKER = $this->input->post('KD_UNKER');

        //update data user 
        $where = array(
            'NIP_BARU' => $NIP, 
        );

        if ($GLRDPN=='' || $GLRBLKG==null)
        {
            $GLRDPN=null;
        }

        $data = array(
            'GLRDPN' => $GLRDPN,
            'NAMA' => $NAMA,
            'GLRBLKG' => $GLRBLKG, 
        );   

        $data2 = array(
            'KD_GOLRU' => $KD_GOLRU, 
            'JABATAN' => $JABATAN, 
        );

        $pesan="";

        $update_user = $this->M_user->update('pengguna', $where, $data); 
        $pesan.="<li>Proses data diri berhasil</li>";  

        $update_pns = $this->M_user->update('tb_dbpns', $where, $data2); 
        $pesan.="<li>Proses update data diri dan data PNS berhasil</li>";
        
        $this->session->set_flashdata('pesan', $pesan); 
        redirect('Datadiri/index/'.$NIK);   
    } 
}
