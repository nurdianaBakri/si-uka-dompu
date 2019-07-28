<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model{

  

  public function getAll()
  {
      $balikan = array();
      $this->db->limit(100, 0); 
      $query = $this->db->get("pengguna");
      $data= $query->result_array();

      foreach ($data as $key)
      { 
        $balikan[] = array(  
          'data_diri' => $key, 
          'jenis_kelamin'=>$this->getById("tb_jk",  array('KD_JK' => $key['KD_JK'] ))->row_array()['NM_JK'],
          'nama_pendidikan'=>$this->getById("tb_pendidikan",  array('KD_PENDIDIKAN' => $key['KD_PDDKN'] ))->row_array()['NM_PENDIDIKAN'],
          // 'data_pns' => $this->getById("tb_dbpns",  array('NIK' => $key['nip'] ))->row_array(), 
        );
      }
      return $balikan;
  } 

  public function getById($tabel,$where)
  {
    $data=$this->db->get_where($tabel,$where);
    return $data;
  }

  public function add($tabel, $data)
  {
    $this->db->insert($tabel, $data);
    return $this->db->insert_id();
  }

  public function update($tabel, $where, $data)
  {
    $this->db->update($tabel, $data, $where);
    return $this->db->affected_rows();
  }

  public function delte($tabel, $where)
  {
    $this->db->where($where);
   return $this->db->delete($tabel);
  }

  function cari($keyword){
      $balikan = array();
      $data_pengguna ="";
     
      if (strlen($keyword)==21)
      {
        //cari data pegawai di tabel tb_dbpns
        $sql ="SELECT * FROM pengguna where NIK like '%$keyword%'";
        $data_pengguna = $this->db->query($sql)->result_array();
      }
      else
      {
        $sql= "SELECT * FROM pengguna where NIP_BARU like '%$keyword%'";
        $data_pengguna = $this->db->query($sql)->result_array();  
      }     

      foreach ($data_pengguna as $key)
      { 
        $balikan[] = array(  
          'data_diri' => $key, 
          'jenis_kelamin'=>$this->getById("tb_jk",  array('KD_JK' => $key['KD_JK'] ))->row_array()['NM_JK'],
          'nama_pendidikan'=>$this->getById("tb_pendidikan",  array('KD_PENDIDIKAN' => $key['KD_PDDKN'] ))->row_array()['NM_PENDIDIKAN'],
        );
      }
      return $balikan;
  }

   function detail($keyword){
      $balikan = array();
      $data_pengguna ="";
     
      if (strlen($keyword)==21)
      {
        //cari data pegawai di tabel tb_dbpns
        $sql ="SELECT * FROM pengguna where NIK like '%$keyword%'";
        $data_pengguna = $this->db->query($sql);
      }
      else
      {
        $sql= "SELECT * FROM pengguna where NIP_BARU like '%$keyword%'";
        $data_pengguna = $this->db->query($sql);  
      }     
      if ($data_pengguna->num_rows()>0)
      {
        $data_pengguna = $data_pengguna->row_array();
        $balikan = array(  
          'data_tidak_ditemukan' => FALSE, 
          'data_diri' => $data_pengguna, 
          'jenis_kelamin'=>$this->getById("tb_jk",  array('KD_JK' => $data_pengguna['KD_JK'] ))->row_array()['NM_JK'],
          'nama_pendidikan'=>$this->getById("tb_pendidikan",  array('KD_PENDIDIKAN' => $data_pengguna['KD_PDDKN'] ))->row_array()['NM_PENDIDIKAN'],
        ); 
      }
      else
      {
          $balikan = array(  
          'data_tidak_ditemukan' => TRUE,  
        ); 
      } 
      return $balikan;
  }



}
