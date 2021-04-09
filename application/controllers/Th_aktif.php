<?php
defined('BASEPATH') or exit('No direct script access allowed');

class th_aktif extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {
            redirect(base_url("auth"));
        }
        $this->load->model('Tahunaktif_model');
        $this->load->helper('url');
    }


    public function index()
    {
        $data['title'] = 'Data tahun aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['tahun_aktif'] = $this->Tahunaktif_model->tampil_data();

        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Thaktif/Index', $data1);
        $this->load->view('Templates/footer');
    }

    function tambah()
    {
        $data['title'] = 'Data tahun aktif';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Thaktif/Tambah_Thaktif');
        $this->load->view('Templates/footer');
    }

    function tambah_aksi()
    {

        $id = $this->input->post('id');
        $nis = $this->input->post('nis');
        $id_tahun = $this->input->post('id_tahun');

        $data = array(
            'id' => $id,
            'nis' => $nis,
            'id_tahun' => $id_tahun
        );

        $query = $this->db->query('SELECT * FROM tahun_aktif 
				WHERE nis =' . $nis . ' AND id_tahun=' . $id_tahun . '');

        if ($query->num_rows() > 0) {
            redirect('Th_aktif/tambah');
        } else {
            $this->Tahunaktif_model->input_data($data, 'tahun_aktif');
            redirect('Th_aktif/tambah_tunggakan/' . $nis . '/' . $id_tahun, '');
        }
    }
    public function deleteTahunaktif()
    {
        $nis = $this->input->get('nis');
        $this->db->delete('tahun_aktif', array('nis' => $nis));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('th_aktif');
    }


    function hapus_tunggakan($nis, $id_tahun)
    {

        $where = array('nis' => $nis, 'id_tahun' => $id_tahun);
        $this->Tahunaktif_model->hapus_data($where, 'tunggakan');
        redirect('Th_aktif');
    }

    function tambah_tunggakan($nis, $id_tahun)
    {

        foreach ($this->db->query('SELECT * FROM tahun_ajaran WHERE id_tahun=' . $id_tahun . '')->result() as $res); {

            $b_spp = $res->besar_spp;

            $tunggakan = $b_spp * 12;
        }

        $data = array(
            'id' => '',
            'nis' => $nis,
            'id_tahun' => $id_tahun,
            'tunggakan' => $tunggakan
        );

        $this->Tahunaktif_model->input_data_tunggakan($data, 'tunggakan');
        redirect('Th_aktif');
    }
}
