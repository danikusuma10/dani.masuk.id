<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('Siswa_model');
        $this->load->helper('url');

    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['jumlahuser'] = $this->Admin_model->jumlahuser();
        $data['jumlahrequest'] = $this->Admin_model->jumlahrequest();
    
    
      
        
        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Sidebar', $data);
        $this->load->view('Templates/Topbar', $data);
        $this->load->view('Admin/Index', $data);
        $this->load->view('Templates/Footer', $data);
    }

}
