<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poligon_m extends CI_Model {
    public function getAllPoligon() {
        $query = $this->db->get('poligon');
        return $query->result();
    }

    public function insertPoligon($data) {
        return $this->db->insert('poligon', $data);
    }

    public function updatePoligon($id, $data) {
        $this->db->where('id_poligon', $id);
        return $this->db->update('poligon', $data);
    }

    public function deletePoligon($id) {
        $this->db->where('id_poligon', $id);
        return $this->db->delete('poligon');
    }
}
?>
