<?php
class KategoriController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Kategori');
    }

    function index()
    {
        $kategori = $this->Kategori->getData();

        $this->load->view('master_data/kategori/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'kategori' => $kategori,
        ]);
    }

    public function create()
    {
        $this->load->view('master_data/kategori/create', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
        ]);
    }

    public function store()
    {
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $umurEkonomis = $this->input->post('umurEkonomis');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'umur_ekonomis' => $umurEkonomis,
        ];

        $this->Kategori->storeData($data);

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('master-data/kategori/create');
    }

    public function edit($id)
    {
        $kategori = $this->Kategori->getDataById($id);
        $kategori = $kategori[0];

        $this->load->view('master_data/kategori/edit', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'kategori' => $kategori,
        ]);
    }

    public function update()
    {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $nama = $this->input->post('nama');
        $umurEkonomis = $this->input->post('umurEkonomis');

        $data = [
            'kode' => $kode,
            'nama' => $nama,
            'umur_ekonomis' => $umurEkonomis,
        ];

        $this->Kategori->updateData($data, $id);

        $this->session->set_flashdata('success', 'Berhasil mengubah data !');
        redirect('master-data/kategori/edit/' . $id);
    }

    public function destroy()
    {
        $id = $this->input->post('id');
        $this->Kategori->destroyData($id);

        $this->session->set_flashdata('success', 'Berhasil menghapus data !');
        redirect('master-data/kategori');
    }

    // =============================================================================
    // Ajax
    // =============================================================================

    public function cekKode()
    {
        $id = $this->input->get('id');
        $kode = $this->input->get('kode');

        $kategori = $this->Kategori->getDataByKode($kode);

        if (empty($kategori)) {
            $status = true;
            $message = 'Kode kategori belum terpakai !';
        } else {
            if ($id) {
                $kategori = $kategori[0];

                if ($id == $kategori['id']) {
                    $status = true;
                    $message = 'Kode kategori belum terpakai !';
                } else {
                    $status = false;
                    $message = 'Kode kategori sudah terpakai !';
                }
            } else {
                $status = false;
                $message = 'Kode kategori sudah terpakai !';
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

        $kategori = $this->Kategori->getDataByNama($nama);

        if (empty($kategori)) {
            $status = true;
            $message = 'Nama kategori belum terpakai !';
        } else {
            if ($id) {
                $kategori = $kategori[0];

                if ($id == $kategori['id']) {
                    $status = true;
                    $message = 'Nama kategori belum terpakai !';
                } else {
                    $status = false;
                    $message = 'Nama kategori sudah terpakai !';
                }
            } else {
                $status = false;
                $message = 'Nama kategori sudah terpakai !';
            }
        }

        $data = [
            'id' => $id,
            'status' => $status,
            'message' => $message,
        ];

        echo json_encode($data);
    }
}
