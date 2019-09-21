<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master_model extends CI_Model{

  var $table = 'books';
  public function __construct()
  {
    parent::__construct();
  }
 	
  public function getAll($tabel)
  {
      $query = $this->db->get($tabel);
      $data= $query->result();
      return $data;
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


}
