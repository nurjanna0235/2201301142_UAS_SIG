<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sig extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lokasi_m');
        $this->load->model('Poligon_m');
    }

    public function index()
    {
        $data['poligon'] = $this->Poligon_m->getAllPoligon();
        $data['lokasi'] = $this->Lokasi_m->get_all();
        $this->load->view('Sig', $data);
    }
}
?>
