<?php
class HomeController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if (!$user) {
            redirect(base_url());
        }
    }

    function index()
    {
        $this->load->view('home/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
        ]);
    }
}
