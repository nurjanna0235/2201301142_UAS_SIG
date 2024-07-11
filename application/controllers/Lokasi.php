<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lokasi_m');

    }

    public function index()
    {
        $data['lokasi'] = $this->Lokasi_m->get_all();
        $this->load->view('Lokasi', $data);
    }

    public function create()
    {
        
        $data = array(
            'nama' => $this->input->post('nama'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude')
        );
        $this->Lokasi_m->insert($data);
        redirect('Lokasi');
    }

    public function edit($id)
    {
        $data['lokasi'] = $this->Lokasi_m->get($id);
        $this->load->view('edit_lokasi', $data);
    }

    public function update($id)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude')
        );
        $this->Lokasi_m->update($id, $data);
        redirect('Lokasi');
    }

    public function delete($id)
    {
        $this->Lokasi_m->delete($id);
        redirect('Lokasi');
    }

    
}
