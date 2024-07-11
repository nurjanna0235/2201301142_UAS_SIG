<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poligon extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Poligon_m');
    }

    public function index() {
        $data['poligon'] = $this->Poligon_m->getAllPoligon();
        $this->load->view('Poligon', $data);
    }

    public function create() {
        $data = array(
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude')
        );
        $this->Poligon_m->insertPoligon($data);
        redirect('Poligon');
    }

    public function update($id) {
        $data = array(
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude')
        );
        $this->Poligon_m->updatePoligon($id, $data);
        redirect('Poligon');
    }

    public function delete($id) {
        $this->Poligon_m->deletePoligon($id);
        redirect('Poligon');
    }
}
?>
