<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hakakses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Hakakses_model');
        $this->load->helper('url');
    }



    //hak akses user
    public function index()
    {
        $data['title'] = 'Hak Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->Hakakses_model->tampil_data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hakakses/index', $data);
        $this->load->view('templates/footer');
    }
    function tambah()
    {
        $data['title'] = 'Data Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hakakses/tambah_user');
    }
    function addAdmin()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');

        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $password = $this->input->post('password');
        $role_id = $this->input->post('user_role');
        $is_active = $this->input->post('is_active');
        $data = array(
            'name' => $name,
            'email' => $email,
            'image' => $upload,
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'role_id' => $role_id,
            'is_active' => $is_active,
            'date_created' => time()
        );

        $this->Hakakses_model->input_data($data, 'user');
        redirect('admin/hakakses');
    }

    private function _do_upload()
    {
        $config['upload_path']         = 'assets/img/profile/';
        $config['allowed_types']     = 'gif|jpg|png|JPG';
        $config['max_size']             = 100;
        $config['max_widht']             = 1000;
        $config['max_height']          = 1000;
        $config['file_name']             = round(microtime(true) * 1000);

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
            redirect('hakakses/index');
        }
        return $this->upload->data('file_name');
    }
    function edit($id)
    {
        $data['title'] = 'Data Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where1 = array('id' => $id);
        $data1['user'] = $this->Hakakses_model->edit_data($where1, 'user')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hakakses/index', $data1);
        $this->load->view('templates/footer');
    }

    function update()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');

        if (!empty($_FILES['image']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        }
        $role_id = $this->input->post('user_role');
        $is_active = $this->input->post('is_active');
        $data = array(
            'name' => $name,
            'email' => $email,
            'image' => $upload,
            'role_id' => $role_id,
            'is_active' => $is_active,
            'date_created' => time()
        );
        $where = array('id' => $id);

        $this->Hakakses_model->update_data($where, $data, 'user');
        redirect('hakakses/index');
    }
    public function deleteAdmin()
    {
        $id = $this->input->get('id');
        $this->db->delete('user', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus Berhasil!
          </div>');
        redirect('hakakses/index');
    }

    function gantipassword()
    {
        $data['title'] = 'Ganti password anda';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('hakakses/gantipassword', $data);
    }

    public function updatepassword()
    {
        $email = $this->session->userdata['email'];

        $this->form_validation->set_rules('baru', 'password_baru', 'required');
        $this->form_validation->set_rules('konfirmasi', 'konfirmasi_password', 'required|matches[baru]');

        $this->form_validation->set_message('required', '%s wajib diisi');

        $this->form_validation->set_error_delimiters('<p class="alert">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('hakakses/gantipassword');
        } else {

            $data = array(
                'password' => password_hash($this->input->post('baru'), PASSWORD_DEFAULT),
            );
            $where = array('email' => $email);

            $this->Hakakses_model->update_data($where, $data, 'user');
            redirect('hakakses/index');
        }
    }
}
