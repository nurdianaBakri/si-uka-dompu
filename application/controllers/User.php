<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('logged_in') != TRUE){
            redirect("Login/index");
        }
    }

    function getAll($idUser)
    {
        if ($idUser==0) 
        {
            # level == protokol
            $data = array('level' => 'protokol' );
            $getallData['data'] = $this->M_user1->getAll($data);
            $getallData['title'] = "Protokol";

            $this->load->view("include/header",$getallData);
            $this->load->view("include/topmenu");
            $this->load->view("include/leftmenuSP" );
            $this->load->view("protokol/protokol" ,$getallData);
            $this->load->view("include/footer");
        }
        else
        {
            $getallData['title'] = "User";
            $kolom = array(
                'id' => $idUser,
            );
            $dataUser = $this->M_user1->detail($kolom);
            $data = array(
                'id_fak' => $dataUser['id_fak'],
                'id_jur' => $dataUser['id_jur'],
                'bagian' => $dataUser['bagian'],
                'subagian' => $dataUser['subagian'],
            );
            $getallData['data'] = $this->M_user1->getAll($data);

            $this->load->view("include/header",$getallData);
            $this->load->view("include/topmenu");
            $this->load->view("include/leftmenu" );
            $this->load->view("user/user" ,$getallData);
            $this->load->view("include/footer");
        }
    }

    public function detailProtokol($idUser)
    {
        $kolom = array(
            'id' => $idUser,
        );

        $getallData['data'] = $this->M_user1->detail($kolom);
        $getallData['asal'] = $this->M_user1->getAsalUser($kolom);
        $getallData['title'] = "Detail Protokol";
        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenuSP" );
        $this->load->view("protokol/detail" ,$getallData);
        $this->load->view("include/footer");

    }

     public function detailUser($idUser)
    {
        $kolom = array(
            'id' => $idUser,
        );

        $getallData['data'] = $this->M_user1->detail($kolom);
        $getallData['asal'] = $this->M_user1->getAsalUser($kolom);
        $getallData['title'] = "Detail User";
       
        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/detail" ,$getallData);
        $this->load->view("include/footer");
    }

    public function ubah()
    {

        $cek="";
        $pesan="";
        $id =  $this->input->post('id');
        $nama = $this->input->post('nama');
        $nama_panggilan = $this->input->post('nama_panggilan');
        $level = $this->input->post('level');
        $username = $this->input->post('username');

        $data = array(
            'level' => $level,
            'id_fak' => $this->input->post('fakultas'),
            'id_jur' => $this->input->post('jurusan'),
            'bagian' => $this->input->post('bagian'),
            'subagian' => $this->input->post('subagian'),
            'active' => 1,
        );

        $data2 = array(
            'level' => $level,
            'id_fak' => $this->input->post('fakultas'),
            'id_jur' => $this->input->post('jurusan'),
            'bagian' => $this->input->post('bagian'),
            'subagian' => $this->input->post('subagian'),
            'nama'=>$nama,
            'nama_panggilan'=>$nama_panggilan,
            'username'=>$username,
            'active' => 1,
        );

        if ($level=='staff' || $level=='protokol' || $level=='dosen' )
        {
            $cek=0;
        }
        else
        {
            $cek=1;
        }

        // start 
        if ($cek==1) 
        {
            //jika pejabat dengan level yang sama masih aktf
            $query = $this->db->get_where("user",$data);
            if ($query->num_rows()>0)
            {
                $pesan = $level." masih aktif, tidak boleh ada 2 $level, silahkan pilih level lain";
            }
            else
            {
                $this->db->where('id',$id);
                $this->db->set($data2);
                $sql =$this->db->update('user'); 
                if ($sql) 
                {
                    $pesan ="Berhasil mengubah data user 1";
                } else {
                    $pesan ="Gagal mengubah data user, silahkan coba kembali";
                }      
            }
        }
        else
        {
            $this->db->where('id',$id);
            $this->db->set($data2);
            $sql =$this->db->update('user'); 
            if ($sql) 
            {
                $pesan ="Berhasil mengubah data user";
            } else {
                $pesan ="Gagal mengubah data user, silahkan coba kembali";
            }      
        }


        $this->session->set_flashdata('pesan', $pesan);

        if ($this->input->post('level_user')!='superadmin') 
        {
            redirect('web/User/detailUser/'.$id);
        }
        else
        {
            redirect('web/User/detailProtokol/'.$id);
        }
    }

    public function nonaktif($user, $admin)
    {
        $data = array();
        $datauser = $this->db->get_where("user",array('id' => $user))->row_array()['active'];
        if ($datauser==0) 
        {
            $data = array(
                'active' => 1,
            );
        }
        else
        {
            $data = array(
                'active' => 0,
            );
        }

        $getallData = $this->M_user1->nonaktif($user,$data);
        if ($getallData==true) 
        {
            $this->session->set_flashdata('pesan', 'Berhasil menonaktifkan user');
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Gagal menonaktifkan user, silahkan coba kembali');
        }
        redirect('web/User/detailUser/'.$admin);
    }

    public function hapus($idUser)
    {
        $getallData= $this->M_user1->hapus($idUser);
        if ($getallData==true) 
        {
            $this->session->set_flashdata('pesan', 'Berhasil menghapus data user');
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Gagal menghapus data user, silahkan coba kembali');
        }

        if ($this->input->get('lvl')!='superadmin') 
        {
            $idAdmin = $this->input->get('usr');
            redirect('web/User/getAll/'.$idAdmin);
        }
        else
        {
            redirect('web/User/getAll/null');
        }

    }

    public function formTambahProtokol()
    {
        $getallData['title'] = "Tambah Protokol";
        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenuSP" );
        $this->load->view("protokol/formTambah" ,$getallData);
        $this->load->view("include/footer");
    }

    public function formTambahUser($user)
    {
        $getallData['title'] = "Tambah User";
        $kolom = array(
            'id' => $user,
        );
        $getallData['data'] = $this->M_user1->detail($kolom);
        $getallData['asal'] = $this->M_user1->getAsalUser($kolom);

        $this->load->view("include/header",$getallData);
        $this->load->view("include/topmenu");
        $this->load->view("include/leftmenu" );
        $this->load->view("user/formTambah" ,$getallData);
        $this->load->view("include/footer");
    }

    public function tambah()
    {
        $ada_pemimpin =false;
        $idAdmin = $this->input->post('admin');

        //character password
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $passwordMD5 = md5($password);

        //get last id user on DB
        $id = $this->db->query("select max(id) as id from user")->row_array()['id']+1;
        $level =  $this->input->post('level');
        $bagian = $this->input->post('bagian');
        $subagian = $this->input->post('subagian');
        $nama= $this->input->post('nama');
        $nama_panggilan= $this->input->post('nama_panggilan');
        $username= $this->input->post('username');
        $fakultas= $this->input->post('fakultas');
        $jurusan= $this->input->post('jurusan');

       /* if ($nama=="" || $level=="" || $bagian=="" || $subagian=="" || $nama_panggilan=="" || $username=="" || $fakultas=="" || $jurusan=="" ) {
            # code...
        }*/

        $data = array(
            'active' => "1", 
            'username' => $username, 
            'password' => $passwordMD5, 
            'id' => $id,
            'nama' => $nama,
            'nama_panggilan' => $nama_panggilan,
            'level' => $level,
            'id_fak' => $fakultas,
            'id_jur' => $jurusan,
            'bagian' => $bagian,
            'subagian' => $subagian,
        );

        //jika memilih sub bagian dan tidak memilih bagian
        //keluarkan erorr
        if ($subagian!="0" && $bagian=="0") 
        {
            $this->session->set_flashdata('pesan', 'mohon isi bagian terlebih dahulu jika ingin mengisi sub bagian');
            $this->session->set_flashdata('jenis', 'gagal');
            if ($this->input->post('level_user')!='superadmin') 
            {
                redirect('web/User/getAll/'.$idAdmin);
            }
            else
            {
                redirect('web/User/getAll/null');
            }
        }
        else
        {
            $data2 = array();

            //jika level inputan != pemimpin, maka masukkan data
            if ($level=='staff' || $level=='dosen' || $level=='protokol' || $level=='biro' || $level=='wd') 
            {
                $data2 = $this->M_user1->tambah($data);
            }
            else
            {
                //jik level inputan == pemimpin, lakukan pengecekkan agar tidak ada 2 pemimpin dalam 1 fakultas/jur/bagian/subbagian
                $dataCheck = array(
                    'id_fak' => $this->input->post('fakultas'),
                    'id_jur' => $this->input->post('jurusan'),
                    'bagian' => $this->input->post('bagian'),
                    'subagian' => $this->input->post('subagian'),
                    'level' => $level, 
                    'active' => 1, 
                );

                //cek jika ada level yang sama
                $query = $this->db->get_where("user",$dataCheck);
                if ($query->num_rows()>0)
                {
                    $ada_pemimpin =true;
                } 
                else
                {
                    $data2 = $this->M_user1->tambah($data);
                }
            }

            //atur kata kta pesan
            if ($data2['sukses']==1) 
            {
                $this->session->set_flashdata('pesan', 'Berhasil menambah data '.$level.', berikut adalah passwordnya : '.$password);

            }
            else
            {
                $this->session->set_flashdata('jenis', 'gagal');
                if ($ada_pemimpin==true) 
                {
                    $this->session->set_flashdata('pesan', 'Level '.$level.' sudah ada, silahkan pilih level lain');
                }
                else
                {
                    $this->session->set_flashdata('pesan', 'Gagal menambah data '.$level.', silahkan coba kembali <br>'.$data2['eror']);
                }
            }

            //atur halaman redirect
            if ($ada_pemimpin==true) 
            {
                //jika gagal menginputkan data karena sudah ada pemimpin, redirect ke tabel data
                if ($this->input->post('level_user')!='superadmin') 
                {
                    redirect('web/User/getAll/'.$idAdmin);
                }
                else
                {
                    redirect('web/User/getAll/null');
                }
            }
            else
            {
                 if ($this->input->post('level_user')!='superadmin') 
                {
                    redirect('web/User/detailUser/'.$id);
                }
                else
                {
                    redirect('web/User/detailProtokol/'.$id);
                }
            }
        }

        
    }

    public function webProfile($idUser)
    {
        $where = array(
            'id=' => $idUser,
        );
        
        $getallData['data'] = $this->M_user1->detail($where);
        $getallData['asal'] = $this->M_user1->getAsalUser($where);
        $getallData['title'] = "Profile User";
        
        $this->load->view("include/header" ,$getallData);
        $this->load->view("include/topmenu" ,$getallData);

        if ($this->input->get('lvl')=='superadmin') 
        {
            $this->load->view("include/leftmenuSP" );
        }
        else
        {
            $this->load->view("include/leftmenu" ,$getallData);
        }
        $this->load->view("user/profile" ,$getallData);
        $this->load->view("include/footer" ,$getallData);
    }

    public function reset($idUser, $admin)
    {
        $data= $this->M_user1->reset($idUser);

        if ($data['sukses']==1) 
        {
            $this->session->set_flashdata('pesan', 'berhasil mereset password, berikut adalah password baru : '.$data['password']);
        }
        else
        {
            $this->session->set_flashdata('pesan', 'Gagal mereset password, silahkan coba kembali');
        }

        redirect('web/User/getAll/'.$admin);
    }
}