<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_user1 extends CI_Model
{
    private $tabel_name = "pengguna";
    public function detail($where)
    {
        $query = $this->db->get_where($this->tabel_name,$where);
        $query = $query->result_array();
        if ($query)
        {
            return $query[0];
        }
    } 

    public function update($data, $iduser, $cek, $level)
    {
        $pesan="";
        //cek variable $cek
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
                $this->db->where('id',$iduser);
                $this->db->set($data);
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
            $this->db->where('id',$iduser);
            $this->db->set($data);
            $sql =$this->db->update('user'); 
            if ($sql) 
            {
                $pesan ="Berhasil mengubah data user";
            } else {
                $pesan ="Gagal mengubah data user, silahkan coba kembali";
            }      
        }
         return ($pesan);
    }

    public function reset($iduser)
    {
         //generate pass
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $passwordMD5 = md5($password);

        $sql = $this->db->query("UPDATE user SET password='$passwordMD5' WHERE id=$iduser");
        if ($sql === TRUE) 
        {
            $dadta = array(
                'password' =>  $password, 
                'sukses' =>  1, 
            );
            return ($dadta);
        }
        else
        {
            $dadta = array(
                'password' =>  'NULL', 
                'sukses' =>  0, 
            );
            return ($dadta);
        }
    }

    public function hapus($where)
    {
        $sukses = 0;
        $sql = $this->db->query("DELETE FROM user WHERE id=$where");
        if ($sql === TRUE) 
        {
            $sukses = 1;
        }
        else
        {
            $sukses = 0;
        }
        return ($sukses);
    }

    public function getUserChats($idUser)
    {
        $sql = $this->db->query("SELECT id, nama, username, nama_panggilan FROM user where id!=$idUser and active=1 and level!='superadmin'")->result_array();
        foreach ($sql as $row) 
        {

            $where = array('id' =>$row['id'] );
            $asal = $this->getAsalUser($where);

            /*$id_user=$row['id'];
            $data_penerima = $this->db->query("SELECT *  from user where id=$id_user")->row_array();

            $id_jur=$data_penerima['id_jur'];
            $id_fk=$data_penerima['id_fak'];
            $id_bagian=$data_penerima['bagian'];
            $id_subbagian=$data_penerima['subagian'];

            $jurusan = $this->db->query("SELECT *  from jurusan where id_jur=$id_jur")->row_array()['nama_jur'];
            $fakultas = $this->db->query("SELECT *  from fakultas where id_fk=$id_fk")->row_array()['nama_fk'];
            $bagian = $this->db->query("SELECT *  from bagiansubag where id=$id_bagian  and jenis='bagian'")->row_array()['nama'];
            $subagian = $this->db->query("SELECT *  from bagiansubag where id=$id_subbagian  and jenis='subbagian'")->row_array()['nama'];*/

            $row['username']=false;
            $row['id_jur']=$asal['nama_jurusan'];
            $row['id_fak']=$asal['nama_fakultas'];
            $row['bagian']=$asal['nama_bagian'];
            $row['subagian']=$asal['nama_subagian'];
            $data[] = $row;
        }
        return ($data);
    }

    public function getUserGroup($idUser)
    {
        $sql = $this->db->query("SELECT id, nama, username, nama_panggilan FROM user where id!=$idUser and active=1 and level!='superadmin'")->result_array();
        foreach ($sql as $row) 
        {
            $where = array('id' =>$row['id'] );
            $asal = $this->getAsalUser($where);

            $row['username']=false;
            $row['id_jur']=$asal['nama_jurusan'];
            $row['id_fak']=$asal['nama_fakultas'];
            $row['bagian']=$asal['nama_bagian'];
            $row['subagian']=$asal['nama_subagian'];
            $data[] = $row;
        }
        return ($data);
    }

    public function getAsalUser($data)
    {
        $data_user = $this->db->get_where("user", $data)->row_array();

        $id_jur=$data_user['id_jur'];
        $id_fk=$data_user['id_fak'];
        $id_bagian=$data_user['bagian'];
        $id_subbagian=$data_user['subagian'];

        $jurusan = $this->db->query("SELECT *  from jurusan where id_jur=$id_jur")->row_array()['nama_jur'];
        $fakultas = $this->db->query("SELECT *  from fakultas where id_fk=$id_fk")->row_array()['nama_fk'];
        $bagian = $this->db->query("SELECT *  from bagiansubag where id=$id_bagian  and jenis='bagian'")->row_array()['nama'];
        $subagian = $this->db->query("SELECT *  from bagiansubag where id=$id_subbagian  and jenis='subbagian'")->row_array()['nama'];

        
        if ($fakultas=="") 
        {
            $fakultas="-";
        }
        if ($jurusan=="") 
        {
            $jurusan="-";
        }
        if ($bagian=="") 
        {
            $bagian="-";
        }
        if ($subagian=="") 
        {
            $subagian="-";
        }
        $arrayName = array(
            'nama_fakultas' => $fakultas, 
            'nama_jurusan' => $jurusan, 
            'nama_bagian' => $bagian, 
            'nama_subagian' => $subagian, 
        );
        return $arrayName;
    }

    public function getProtokol($id_pemimpin)
    {
        $user = array(
            'id=' => $id_pemimpin,
        );
        $dataStaff= $this->M_user1->detail($user);
        $id_fak=$dataStaff['id_fak'];
        $id_jur=$dataStaff['id_jur'];
        $bagian=$dataStaff['bagian'];
        $subagian=$dataStaff['subagian'];
        $txt1 ="SELECT id, level from user where id in(SELECT id FROM user where id_fak=$id_fak and id_jur=$id_jur and subagian=$subagian and bagian=$bagian AND active=1) and level='protokol'";
        $query = $this->db->query($txt1)->row_array();
        return $query;
    }

    public function ubahProtokol($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->set($data);
        $sql =$this->db->update('user');
        return $sql;
    }

    public function nonaktif($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->set($data);
        $sql =$this->db->update('user');
        return $sql;
    }
}