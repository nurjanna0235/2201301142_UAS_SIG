<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_m extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all() {
        return $this->db->get('lokasi')->result();
    }

    public function insert($data) {
        return $this->db->insert('lokasi', $data);
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('lokasi')->row();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('lokasi', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('lokasi');
    }

    public function get_data_limit($start, $limit) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('lokasi'); // Sesuaikan dengan nama tabel Anda
        return $query->result();
    }
    
}
?>
