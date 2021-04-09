<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('User');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'YPT Smart Login';
            $this->load->view('Templates/Auth_header', $data);
            $this->load->view('Auth/Login');
            $this->load->view('Templates/Auth_footer');
        } else {
            // jika validasinya success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();


        //jika User ada
        if ($user) {
            // jika user aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 2) {
                        redirect('User');
                    } else {
                        redirect('Admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password Salah!</div>
                    ');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                email belum di aktifkan!</div>
                ');
                redirect('Auth');
            }
        } else {
            //user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email ini belum di registrasi!</div>
            ');
            redirect('Auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('User');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'email ini sudah pernah terdaftar!',
            'required' => 'email tidak boleh kosong!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'password tidak boleh kosong!',
            'matches' => 'password tidak cocok!',
            'min_length'    => 'password terlalu pendek, minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'YPT PAYMENT Registration';
            $this->load->view('Templates/Auth_header', $data);
            $this->load->view('Auth/Registration');
            $this->load->view('Templates/Auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email'        => $email,
                'token'        => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat! akun berhasil di registrasi. silahkan periksa email untuk aktivasi akun</div>
            ');
            redirect('Auth');
        }
    }


    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://mail.dani.masuk.id',
            'smtp_user' => 'ypt1smartpay@dani.masuk.id',
            'smtp_pass' => 'beliveme16',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'crlf'      => "\r\n",
            'newline'   => "\r\n",
            'underwarp'=> true
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('ypt1smartpay@dani.masuk.id', 'YPT PAYMENT CONFIRMATION');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Kode Aktivasi Akun YPT PAYMENT');
            $this->email->message('silahkan klik tombol berikut untuk aktivasi akun Smart Payment YPT 1 Purbalingga : <a href="' . base_url() . 'Auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" type="button" style="color: green;">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password Akun YPT PAYMENT');
            $this->email->message('silahkan klick tombol berikut untuk reset password akun  YPT PAYMENT : <a href="' . base_url() . 'Auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" type="button" style="color: green;">Reset Password</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 0);
                    $this->db->set('role_id', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . '
                    berhasil diaktifkan, silahkan login!</div>
                    ');
                    redirect('Auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Aktivasi gagal, token anda expired!</div>
                    ');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Aktivasi gagal, token anda salah!</div>
        ');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Aktivasi gagal, email salah!</div>
        ');
            redirect('Auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('rol_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        anda sudah logged out!</div>
        ');
        redirect('Auth');
    }


    public function blocked()
    {
        $this->load->view('Auth/Blocked');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'YPT1PBG Forgot Password';
            $this->load->view('Templates/Auth_header', $data);
            $this->load->view('Auth/Forgotpassword');
            $this->load->view('Templates/Auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Cek email anda untuk reset password</div>
                ');
                redirect('Auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email belum di registrasi atau belum diaktifkan</div>
                ');
                redirect('Auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            // jika user ada.
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                // jika token ada
                // buat session untuk change password.
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                // jika token tidak ada
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal !, token salah.</div>
            ');
                redirect('Auth');
            }
        } else {
            // jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset password gagal !, email salah.</div>
            ');
            redirect('Auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('Auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'YPT1PBG Change Password';
            $this->load->view('Templates/Auth_header', $data);
            $this->load->view('Auth/Changepassword');
            $this->load->view('Templates/Auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            // hapus sesi change password
            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            password berhasil diganti !, silahkan login.</div>
            ');
            redirect('Auth');
        }
    }
}
