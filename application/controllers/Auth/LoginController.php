<?php
class LoginController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Pengguna');
    }

    public function cekLogin()
    {
        $user = $this->session->userdata('user');

        if ($user) {
            redirect('home');
        }
    }

    function index()
    {
        $this->cekLogin();

        $this->load->view('login/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
        ]);
    }

    public function register()
    {
        $username = 'budi';

        $options = [
            'cost' => 12,
        ];

        $password = 'budi';
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        $data = [
            'username' => $username,
            'password' => $password,
            'level' => 'pegawai',
        ];

        $this->Pengguna->storeData($data);

        echo "Sukses membuat akun";
    }

    public function authenticate()
    {
        $this->cekLogin();

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = $this->Pengguna->getByUsername($username);

        if (empty($data)) {
            $this->session->set_flashdata('fail', 'Username tidak ditemukan !');
            redirect(base_url());
        }

        if (!password_verify($password, $data[0]['password'])) {
            $this->session->set_flashdata('fail', 'Password salah !');
            redirect(base_url());
        }

        $session = [
            'username' => $data[0]['username'],
            'level' => $data[0]['level'],
        ];

        $this->session->set_userdata('user', $session);

        redirect('home');
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('user');

        redirect(base_url());
    }
}
