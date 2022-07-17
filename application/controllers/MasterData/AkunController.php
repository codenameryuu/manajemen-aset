<?php
class AkunController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Akun');
    }

    function index()
    {
        $akun = $this->Akun->getData();

        $this->load->view('master_data/akun/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'akun' => $akun,
        ]);
    }

    public function create()
    {
        $this->load->view('master_data/akun/create', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
        ]);
    }

    public function store()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
        ];

        $this->Akun->storeData($data);

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('master-data/akun/create');
    }

    public function edit($id)
    {
        $akun = $this->Akun->getDataById($id);
        $akun = $akun[0];

        $this->load->view('master_data/akun/edit', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'akun' => $akun,
        ]);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
        ];

        $this->Akun->updateData($data, $id);

        $this->session->set_flashdata('success', 'Berhasil mengubah data !');
        redirect('master-data/akun/edit/' . $id);
    }

    public function destroy()
    {
        $id = $this->input->post('id');
        $this->Akun->destroyData($id);

        $this->session->set_flashdata('success', 'Berhasil menghapus data !');
        redirect('master-data/akun');
    }

    // =============================================================================
    // Ajax
    // =============================================================================

    public function cekKode()
    {
        $id = $this->input->get('id');
        $kode = $this->input->get('kode');

        $akun = $this->Akun->getDataByKodeAkun($kode);

        if (empty($akun)) {
            $status = true;
            $message = 'Kode akun belum terpakai !';
        } else {
            if ($id) {
                $akun = $akun[0];

                if ($id == $akun['id']) {
                    $status = true;
                    $message = 'Kode akun belum terpakai !';
                } else {
                    $status = false;
                    $message = 'Kode akun sudah terpakai !';
                }
            } else {
                $status = false;
                $message = 'Kode akun sudah terpakai !';
            }
        }

        $data = [
            'status' => $status,
            'message' => $message,
        ];

        echo json_encode($data);
    }

    public function cekNama()
    {
        $id = $this->input->get('id');
        $nama = $this->input->get('nama');

        $akun = $this->Akun->getDataByNama($nama);

        if (empty($akun)) {
            $status = true;
            $message = 'Nama akun belum terpakai !';
        } else {
            if ($id) {
                $akun = $akun[0];

                if ($id == $akun['id']) {
                    $status = true;
                    $message = 'Nama akun belum terpakai !';
                } else {
                    $status = false;
                    $message = 'Nama akun sudah terpakai !';
                }
            } else {
                $status = false;
                $message = 'Nama akun sudah terpakai !';
            }
        }

        $data = [
            'status' => $status,
            'message' => $message,
        ];

        echo json_encode($data);
    }
}
