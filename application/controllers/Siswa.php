<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('Siswa_model');
        $this->load->helper('url');
       
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data1['siswa'] = $this->Siswa_model->tampil_data()->result();

        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Siswa/Index', $data1);
        $this->load->view('Templates/Footer');
    }

    function tambah()
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('Templates/Header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Siswa/Tambah_siswa');
        $this->load->view('Templates/Footer');
    }
    function tambah_aksi()
    {

        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');

        $no_hp_siswa = $this->input->post('no_hp_siswa');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $is_active = $this->input->post('is_active');
        $data = array(
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,

            'no_hp_siswa' => $no_hp_siswa,
            'id_tahun' => $tahun_ajaran,
            'role_id' => 2,
            'is_active' => $is_active
        );

        $this->Siswa_model->input_data($data, 'siswa');
        redirect('Siswa');
    }

    function edit($nis)
    {
        $data['title'] = 'Data Siswa';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('nis' => $nis);
        $data1['siswa'] = $this->Siswa_model->edit_data($where1, 'siswa')->result();
        $this->load->view('Templates/Header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Siswa/Edit_siswa', $data1);
        $this->load->view('Templates/Footer');
    }

    function update()
    {
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');

        $no_hp_siswa = $this->input->post('no_hp_siswa');
        $tahun_ajaran = $this->input->post('tahun_ajaran');
        $is_active = $this->input->post('is_active');
        $data = array(
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,

            'no_hp_siswa' => $no_hp_siswa,
            'id_tahun' => $tahun_ajaran,
            'is_active' => $is_active
        );
        $where = array('nis' => $nis);

        $this->Siswa_model->update_data($where, $data, 'siswa');
        redirect('Siswa');
    }

    public function deleteSiswa()
    {
        $id = $this->input->get('nis');
        $this->db->delete('siswa', array('nis' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('Siswa');
    }
 

    
}
