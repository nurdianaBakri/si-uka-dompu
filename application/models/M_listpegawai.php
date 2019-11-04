<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_listpegawai extends CI_Model{

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

  public function delete($tabel, $where)
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


    public function detail($where)
  {
    $data_balikan = array();
    $data=$this->db->get_where("tb_dbpns",$where);
    if ($data->num_rows()>0)
    { 
      $data= $data->row_array();
      $data_golru = $this->getById("tb_golru",  array('KD_GOLRU' => $data['KD_GOLRU'] ))->row_array();
      $data_unker = $this->getById("tb_kdunker",  array('KD_UNKER' => $data['KD_UNKER'] ))->row_array();
      $data_skCpns = $this->getById("tb_skcpns",  array('NIK' => $data['NIK'] ))->row_array(); 
      $data_skPangkatTerakhir = $this->getById("tb_sk_pangkat_terakhir",  array('NIK' => $data['NIK'] ))->row_array(); 
      $data_pengguna = $this->getById("pengguna",  array('NIK' => $data['NIK'] ))->row_array(); 

      //get data sk_pns
      $data_skPns = $this->getById("tb_skpns",  array('NIP_BARU' => $data['NIP_BARU'] ))->row_array();
      $data_ket_jabatan = $this->getAllfROMaTABEL('tb_jenisjabatan')->result_array();
      $data_kd_unker = $this->getAllfROMaTABEL('tb_kdunker')->result_array();

      $data_balikan = array(
        'data' => $data, 
        'data_golru' => $data_golru, 
        'data_unker' => $data_unker, 
        'data_pengguna' => $data_pengguna, 
        'data_skCpns' => $data_skCpns, 
        'data_sk_pns' => $data_skPns,
        'data_skPangkatTerakhir' => $data_skPangkatTerakhir,  
        'data_kd_unker' => $data_kd_unker, 
        'data_ket_jabatan' => $data_ket_jabatan, 
        'data_tidak_ditemukan' => FALSE, 
      );
    }
    else
    {
      $data_balikan['data_tidak_ditemukan']=TRUE;

    } 
    return $data_balikan;
  }


  public function getAllfROMaTABEL($tabel)
  {
    return $this->db->get($tabel);
  }




}
