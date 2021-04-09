<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Th_ajaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {
            redirect(base_url("Auth"));
        }
        $this->load->model('Tahunajaran_model');
        $this->load->helper('url');
    }


    public function Index()
    {
        $data['title'] = 'Data tahun ajaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_ajaran'] = $this->Tahunajaran_model->tampil_data()->result();

        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Thajaran/Index', $data1);
        $this->load->view('Templates/Footer');
    }

    function tambah()
    {
        $data['title'] = 'Data tahun ajaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Thajaran/Tambah_thajaran');
        $this->load->view('Templates/Footer');
    }
    function tambah_aksi()
    {

        $id_tahun = $this->input->post('id_tahun');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $besar_spp = $this->input->post('besar_spp');

        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_ajaran' => $tahun_ajaran,
            'besar_spp' => $besar_spp
        );

        $this->Tahunajaran_model->input_data($data, 'tahun_ajaran');
        redirect('Th_ajaran');
    }

    function edit($id_tahun)
    {
        $data['title'] = 'Data tahun ajaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id_tahun' => $id_tahun);
        $data1['tahun_ajaran'] = $this->Tahunajaran_model->edit_data($where1, 'tahun_ajaran')->result();
        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('thajaran/Edit_thajaran', $data1);
        $this->load->view('Templates/Footer');
    }

    function update()
    {
        $id_tahun = $this->input->post('id_tahun');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $besar_spp = $this->input->post('besar_spp');
        $data = array(
            'id_tahun' => $id_tahun,
            'tahun_ajaran' => $tahun_ajaran,
            'besar_spp' => $besar_spp
        );
        $where = array('id_tahun' => $id_tahun);

        $this->Tahunajaran_model->update_data($where, $data, 'tahun_ajaran');
        redirect('Th_ajaran');
    }
    public function deleteAjaran()
    {
        $id_tahun = $this->input->get('id_tahun');
        $this->db->delete('tahun_ajaran', array('id_tahun' => $id_tahun));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('Th_ajaran');
    }
}
