<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model 
{ 

  //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('NIK_BARU');
    }

    //fungsi check login
    function check_login($u, $p)
    { 
        $this->db->where('NIP_BARU', $u); 
        $this->db->where('password', md5($p)); 
        $query = $this->db->get('pengguna');
        // return $query;
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }


	public function logincek($u, $p)
    {
        $data = array();
        $nama="";
        $p = md5($p);
        $where = array('NIP_BARU' => $u, 'password'=> $p );
        $query = $this->db->get_where('pengguna',$where);

        if($query->num_rows()===1)// beriksa baris ada atau tidak 
        { 
          $row= $query->row();
          $data = array(
            'NIP_BARU'=> $row->NIP_BARU,
            'NIK'=> $row->NIK,
            'NAMA'=> $row->NAMA,
            'level'=> $row->level,
            'logged_in'=>TRUE,
          );  

          //set user data
          $this->session->set_userdata($data);
        }
        else
        {
          $data = array(
            'logged_in'=>FALSE,
            'NIP_BARU'=> '',
            'NIK'=> '',
            'NAMA'=> '',
            'level'=> '',
          );
          $this->session->set_userdata($data);

        }
        return $data;
    }

}