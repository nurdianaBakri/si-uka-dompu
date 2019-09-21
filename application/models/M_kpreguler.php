<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kpreguler extends CI_Model{

  public function getAll()
  {

    $data_pegawai = array();
    $this->db->limit(100, 0);
    $data = $this->db->get('tb_dbpns')->result_array(); 
    foreach ($data as $key) {

      //get data pendidikan 
      $this->db->where('KD_PENDIDIKAN',$key['KD_PDDKN']);
      $pendidikan = $this->db->get('tb_pendidikan')->row_array();
      $key['KD_PDDKN'] = $pendidikan['NM_PENDIDIKAN'];

      //GET DATA DIRI  
      $this->db->where('NIK',$key['NIK']);
      $data_pengguna = $this->db->get('pengguna')->row_array();
      $key['data_pengguna'] = $data_pengguna; 
      
      $data_pegawai[] = $key;
    }

    return $data_pegawai;
  }

  public function cari($searchvalue)
  {
      $balikan = array();
      $data_pns ="";
      $sql =""; 
      //nik
      if (strlen($searchvalue)==21)
      {
        //cari data pegawai di tabel tb_dbpns
        $sql ="SELECT * FROM tb_dbpns where NIK like '%$searchvalue%'";
        $data_pns = $this->db->query($sql)->result_array();
      }
      else
      {
        $sql= "SELECT * FROM tb_dbpns where NIP_BARU like '%$searchvalue%'";
        $data_pns = $this->db->query($sql)->result_array();  
      } 
     
      foreach ($data_pns as $key) { 
        // get data pendidikan 
        $this->db->where('KD_PENDIDIKAN',$key['KD_PDDKN']);
        $pendidikan = $this->db->get('tb_pendidikan')->row_array();
        $key['KD_PDDKN'] = $pendidikan['NM_PENDIDIKAN'];

        //GET DATA DIRI  
        $this->db->where('NIK',$key['NIK']);
        $data_pengguna = $this->db->get('pengguna')->row_array();
        $key['data_pengguna'] = $data_pengguna; 
        $key['sql'] = $sql; 
        
        $balikan[] = $key;
      }
    return ($balikan);
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

  public function getById($tabel, $data)
  {
    $this->db->where($data);
    return $this->db->get($tabel);
  } 

   public function getAllfROMaTABEL($tabel)
  {
    return $this->db->get($tabel);
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


}
